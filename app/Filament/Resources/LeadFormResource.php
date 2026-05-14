<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadFormResource\Pages\CreateLeadForm;
use App\Filament\Resources\LeadFormResource\Pages\EditLeadForm;
use App\Filament\Resources\LeadFormResource\Pages\ListLeadForms;
use App\Filament\Resources\LeadFormResource\RelationManagers\FieldsRelationManager;
use App\Models\LeadForm;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LeadFormResource extends Resource
{
    protected static ?string $model = LeadForm::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static string|\UnitEnum|null $navigationGroup = 'Lead Builder';

    protected static ?string $navigationLabel = 'Formularios';

    protected static ?string $modelLabel = 'Formulario';

    protected static ?string $pluralModelLabel = 'Formularios';

    protected static ?int $navigationSort = 1;

    public const RESERVED_PUBLIC_URLS = [
        'admin', 'api', 'livewire', 'login', 'register', 'password', 'logout',
        'vehiculo', 'vehiculos', 'forms', 'lead', 'credito',
        'dashboard', 'backend', 'fortuna', 'gracias',
        'clientegeely', 'test-email', 'vehicles',
        'storage', 'up',
    ];

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Formulario')->tabs([

                Tab::make('Configuracion general')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nombre')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, callable $set, ?LeadForm $record) {
                                if (! $record) {
                                    $set('slug', Str::slug((string) $state));
                                }
                            })
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('Slug interno')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Usado en /lead/{slug}. Solo minusculas, numeros y guiones.')
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Descripcion (interna)')
                            ->rows(2)
                            ->columnSpanFull(),
                        TextInput::make('public_url')
                            ->label('URL publica personalizada')
                            ->placeholder('clientegeely-v2')
                            ->prefix('geely.com.bo/')
                            ->unique(ignoreRecord: true)
                            ->regex('/^[a-z0-9-]+$/')
                            ->helperText('Opcional. Si vacio, accesible solo en /lead/{slug}. Solo minusculas, numeros y guiones.')
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, \Closure $fail) {
                                        if ($value && in_array($value, self::RESERVED_PUBLIC_URLS, true)) {
                                            $fail("La URL '{$value}' esta reservada por el sistema.");
                                        }
                                    };
                                },
                            ]),
                        Toggle::make('is_active')
                            ->label('Activo')
                            ->default(true)
                            ->helperText('Solo los formularios activos son accesibles publicamente.'),
                    ])->columns(2),

                Tab::make('Notificaciones')
                    ->icon('heroicon-o-envelope')
                    ->schema([
                        TagsInput::make('notification_emails')
                            ->label('Emails que reciben cada lead')
                            ->placeholder('ventas@geely.com.bo')
                            ->nestedRecursiveRules(['email'])
                            ->helperText('Presiona Enter despues de cada email.')
                            ->columnSpanFull(),
                        TextInput::make('email_subject')
                            ->label('Asunto del email')
                            ->placeholder('Nuevo lead desde {form_name}')
                            ->helperText('Si vacio, se usa "Nuevo lead: {nombre del formulario}".')
                            ->columnSpanFull(),
                        Toggle::make('send_confirmation_to_user')
                            ->label('Enviar email de confirmacion al cliente')
                            ->default(false)
                            ->live(),
                        Select::make('confirmation_email_field')
                            ->label('Campo que contiene el email del cliente')
                            ->options(function (?LeadForm $record) {
                                if (! $record) {
                                    return [];
                                }
                                return $record->fields()
                                    ->where('type', 'email')
                                    ->pluck('label', 'name')
                                    ->toArray();
                            })
                            ->helperText('Guarda primero el formulario y agrega un campo tipo email para verlo aqui.')
                            ->visible(fn (callable $get) => (bool) $get('send_confirmation_to_user')),
                    ])->columns(2),

                Tab::make('Mensajes y redireccion')
                    ->icon('heroicon-o-chat-bubble-bottom-center-text')
                    ->schema([
                        Textarea::make('success_message')
                            ->label('Mensaje de exito')
                            ->rows(2)
                            ->default('Gracias, hemos recibido tu información.')
                            ->columnSpanFull(),
                        TextInput::make('submit_button_text')
                            ->label('Texto del boton de envio')
                            ->default('Enviar'),
                        TextInput::make('redirect_url')
                            ->label('URL de redireccion (opcional)')
                            ->helperText('Si se llena, se redirige al cliente despues de enviar. Si vacio, muestra el mensaje de exito.'),
                    ])->columns(2),

            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('slug')->label('Slug')->badge()->color('gray'),
                TextColumn::make('public_url')
                    ->label('URL publica')
                    ->formatStateUsing(fn (?string $state, LeadForm $record) => $record->resolved_url)
                    ->copyable(),
                TextColumn::make('fields_count')->counts('fields')->label('Campos'),
                TextColumn::make('submit_count')->label('Envios')->badge()->color('success'),
                IconColumn::make('is_active')->label('Activo')->boolean(),
                TextColumn::make('updated_at')->label('Actualizado')->since(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->filters([
                TernaryFilter::make('is_active')->label('Activo'),
            ])
            ->recordActions([
                Action::make('view_url')
                    ->label('Ver URL publica')
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->url(fn (LeadForm $record) => url($record->resolved_url))
                    ->openUrlInNewTab(),
                Action::make('view_leads')
                    ->label('Ver leads')
                    ->icon('heroicon-o-inbox-stack')
                    ->visible(fn () => class_exists(\App\Filament\Resources\LeadResource::class))
                    ->url(fn (LeadForm $record) => class_exists(\App\Filament\Resources\LeadResource::class)
                        ? \App\Filament\Resources\LeadResource::getUrl('index', ['tableFilters[lead_form_id][value]' => $record->id])
                        : '#'),
                EditAction::make(),
                Action::make('duplicate')
                    ->label('Duplicar')
                    ->icon('heroicon-o-document-duplicate')
                    ->action(function (LeadForm $record) {
                        $copy = $record->replicate(['submit_count']);
                        $copy->name = $record->name . ' (copia)';
                        $copy->slug = $record->slug . '-copia-' . Str::random(4);
                        $copy->public_url = null;
                        $copy->submit_count = 0;
                        $copy->is_active = false;
                        $copy->save();

                        foreach ($record->fields as $field) {
                            $newField = $field->replicate();
                            $newField->lead_form_id = $copy->id;
                            $newField->save();
                        }

                        Notification::make()
                            ->success()
                            ->title('Formulario duplicado')
                            ->body("Se creo una copia inactiva: {$copy->name}")
                            ->send();
                    })
                    ->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            FieldsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeadForms::route('/'),
            'create' => CreateLeadForm::route('/create'),
            'edit' => EditLeadForm::route('/{record}/edit'),
        ];
    }
}
