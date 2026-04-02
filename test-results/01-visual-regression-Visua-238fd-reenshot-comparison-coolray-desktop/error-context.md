# Instructions

- Following Playwright test failed.
- Explain why, be concise, respect Playwright best practices.
- Provide a snippet of code with the fix, if possible.

# Test info

- Name: 01-visual-regression.spec.ts >> Visual Regression: Prod vs Local >> Screenshot comparison: coolray
- Location: tests\e2e\01-visual-regression.spec.ts:47:5

# Error details

```
TimeoutError: page.goto: Timeout 45000ms exceeded.
Call log:
  - navigating to "https://geely.com.bo/vehiculos/suv/coolray", waiting until "networkidle"

```

# Page snapshot

```yaml
- generic [active] [ref=e1]:
  - banner [ref=e2]:
    - navigation [ref=e4]:
      - link "Geely Bolivia" [ref=e6] [cursor=pointer]:
        - /url: /
        - img "Geely Bolivia" [ref=e7]
  - main [ref=e8]:
    - generic [ref=e9]:
      - generic [ref=e12]:
        - img "COOLRAY" [ref=e14]
        - generic [ref=e16]:
          - heading "COOLRAY" [level=1] [ref=e17]
          - paragraph [ref=e18]: SUV PERFECTA PARA LA VIDA URBANA
        - generic [ref=e22]:
          - generic [ref=e23]:
            - generic [ref=e25]: "1.5"
            - paragraph [ref=e26]: Motor
          - generic [ref=e27]:
            - generic [ref=e28]:
              - generic [ref=e29]: "122"
              - generic [ref=e30]: hp
            - paragraph [ref=e31]: Potencia
          - generic [ref=e32]:
            - generic [ref=e34]: "5"
            - paragraph [ref=e35]: Velocidades
          - generic [ref=e36]:
            - generic [ref=e37]:
              - generic [ref=e38]: "5"
              - generic [ref=e39]: MT|CVT
            - paragraph [ref=e40]: Transmisión
      - navigation [ref=e44]:
        - list [ref=e45]:
          - listitem [ref=e46]:
            - link "Coolray" [ref=e47] [cursor=pointer]:
              - /url: "#hero"
              - text: Coolray
          - listitem [ref=e48]:
            - link "Versiones" [ref=e49] [cursor=pointer]:
              - /url: "#versiones"
              - text: Versiones
          - listitem [ref=e50]:
            - link "Tecnología" [ref=e51] [cursor=pointer]:
              - /url: "#tecnologia"
              - text: Tecnología
          - listitem [ref=e52]:
            - link "Diseño" [ref=e53] [cursor=pointer]:
              - /url: "#diseno"
              - text: Diseño
      - generic [ref=e56]:
        - generic [ref=e58]:
          - heading "Donde lo urbano se vuelve Premium" [level=2] [ref=e59]
          - paragraph [ref=e60]: 3 razones para elegir a Geely COOLRAY
        - generic [ref=e61]:
          - generic [ref=e62] [cursor=pointer]:
            - img "Confort" [ref=e64]
            - generic [ref=e66]:
              - heading "Confort" [level=3] [ref=e67]
              - paragraph [ref=e68]: Asientos de ecocuero
          - generic [ref=e70] [cursor=pointer]:
            - img "Estilo" [ref=e72]
            - generic [ref=e74]:
              - heading "Estilo" [level=3] [ref=e75]
              - paragraph [ref=e76]: Diseño deportivo
          - generic [ref=e78] [cursor=pointer]:
            - img "Comodidad" [ref=e80]
            - generic [ref=e82]:
              - heading "Comodidad" [level=3] [ref=e83]
              - paragraph [ref=e84]: Amplio espacio interior
      - generic [ref=e89]:
        - generic [ref=e90]:
          - heading "VERSIONES Y PRECIOS" [level=2] [ref=e91]
          - paragraph [ref=e92]: Elige tu versión de COOLRAY
        - generic [ref=e94]:
          - generic [ref=e95]:
            - combobox [ref=e97]:
              - option "COMFORT MT" [selected]
              - option "COMFORT CVT"
            - generic [ref=e98]:
              - generic [ref=e99]:
                - generic [ref=e100]: "Cilindrada:"
                - generic [ref=e101]: 1499 cc con 122 HP
              - generic [ref=e102]:
                - generic [ref=e103]: "Transmisión:"
                - generic [ref=e104]: 5MT
              - generic [ref=e105]:
                - generic [ref=e106]: "Tracción:"
                - generic [ref=e107]: FWD Delantera
              - generic [ref=e108]:
                - generic [ref=e109]: "Plataforma:"
                - generic [ref=e110]: "-"
            - generic [ref=e112]:
              - button "PRECIO" [ref=e113] [cursor=pointer]
              - button "MOTOR" [ref=e114] [cursor=pointer]
              - button "EQUIPAMIENTO" [ref=e115] [cursor=pointer]
              - button "SEGURIDAD" [ref=e116] [cursor=pointer]
            - generic [ref=e118]:
              - generic [ref=e119]:
                - generic [ref=e120]: "Año Comercial:"
                - generic [ref=e121]: "2026"
              - generic [ref=e122]:
                - generic [ref=e123]: "Precio de lista:"
                - generic [ref=e124]: $us.26,990
              - generic [ref=e125]:
                - generic [ref=e126]: "Descuento Lanzamiento:"
                - generic [ref=e127]: $us. 1,000
              - generic [ref=e128]:
                - generic [ref=e129]: "Precio final:"
                - generic [ref=e130]: $us. 25,990
            - generic [ref=e131]:
              - button "Obtener Cotización" [ref=e132] [cursor=pointer]
              - button "Descargar Catálogo" [ref=e133] [cursor=pointer]
              - button "Agendar Test Drive" [ref=e134] [cursor=pointer]
              - link "Consulta por Whatsapp" [ref=e135] [cursor=pointer]:
                - /url: "#"
          - generic [ref=e136]:
            - generic [ref=e138]:
              - button "Exterior" [ref=e139] [cursor=pointer]
              - button "Interior" [ref=e140] [cursor=pointer]
            - img "exterior" [ref=e144]
            - generic [ref=e146]:
              - button "Azul" [ref=e147] [cursor=pointer]
              - button "Blanco" [ref=e149] [cursor=pointer]
              - button "Gris" [ref=e150] [cursor=pointer]
              - button "Plata" [ref=e151] [cursor=pointer]
      - generic [ref=e154]:
        - heading "¿QUÉ DESEAS HACER HOY?" [level=2] [ref=e155]
        - generic [ref=e156]:
          - link "WHATSAPP" [ref=e157] [cursor=pointer]:
            - /url: https://wa.me/59177595558?text=Hola%2C%20vi%20el%20sitio%20web%20Geely%20y%20deseo%20atenci%C3%B3n%20personalizada&utm_source=web%20visit&utm_medium=website&utm_campaign=none
            - generic [ref=e158]:
              - img [ref=e160]
              - heading "WHATSAPP" [level=3] [ref=e162]
          - link "COTIZAR" [ref=e163] [cursor=pointer]:
            - /url: https://geely.com.bo/forms
            - generic [ref=e164]:
              - img [ref=e166]
              - heading "COTIZAR" [level=3] [ref=e172]
          - link "DIRECCIONES" [ref=e173] [cursor=pointer]:
            - /url: "#direcciones"
            - generic [ref=e174]:
              - img [ref=e176]
              - heading "DIRECCIONES" [level=3] [ref=e179]
          - link "CONTÁCTANOS" [ref=e180] [cursor=pointer]:
            - /url: https://geely.com.bo/forms
            - generic [ref=e181]:
              - img [ref=e183]
              - heading "CONTÁCTANOS" [level=3] [ref=e188]
      - generic [ref=e191]:
        - generic [ref=e192]:
          - generic [ref=e193]:
            - heading "CON GEELY OBTIENES MÁS" [level=2] [ref=e194]
            - paragraph [ref=e195]: Geely te da los mejores beneficios y condiciones del mercado para que puedas empezar a conducir con total tranquilidad.
          - generic [ref=e196]:
            - heading "GARANTÍA EXTENDIDA" [level=3] [ref=e197]
            - generic [ref=e198]:
              - generic [ref=e199]:
                - generic [ref=e200]: "5"
                - generic [ref=e201]: AÑOS
              - generic [ref=e202]: ó
              - generic [ref=e203]:
                - generic [ref=e204]: "150.000"
                - generic [ref=e205]: KM
          - generic [ref=e206]:
            - heading "Y MANTENIMIENTOS INCLUIDOS" [level=3] [ref=e207]
            - generic [ref=e208]:
              - generic [ref=e209]:
                - generic [ref=e210]: "6"
                - generic [ref=e211]: SERVICIOS
              - generic [ref=e212]: EN
              - generic [ref=e213]:
                - generic [ref=e214]: "3"
                - generic [ref=e215]: AÑOS
        - paragraph [ref=e217]: Lo que ocurra primero
      - generic [ref=e220]:
        - generic [ref=e221]:
          - heading "VIDEOS Y RESEÑAS" [level=2] [ref=e222]
          - paragraph [ref=e223]: Conoce todo sobre Geely COOLRAY con los siguientes videos
        - generic [ref=e225]:
          - generic [ref=e226]:
            - heading "REVIEW COOLRAY" [level=3] [ref=e227]
            - paragraph [ref=e228]: Reseñas
          - generic [ref=e232]:
            - img "This is where the ride can get for your video" [ref=e233]
            - button [ref=e235] [cursor=pointer]:
              - img [ref=e236]
            - generic [ref=e238]: 05:31
        - button [ref=e241] [cursor=pointer]
      - generic [ref=e246]:
        - heading "GEELY COOLRAY" [level=2] [ref=e247]
        - paragraph [ref=e248]: Caracteristicas
      - generic [ref=e251]:
        - heading "MODERNA Y EXCLUSIVA" [level=2] [ref=e254]
        - generic [ref=e256]:
          - generic [ref=e260]:
            - heading "Motor 1.5 Turbo" [level=3] [ref=e261]
            - paragraph [ref=e262]: 122 HP Potencia
            - paragraph [ref=e263]: La SUV que necesitas para la ciudad y la vida urbana
          - generic [ref=e264]:
            - generic [ref=e265] [cursor=pointer]:
              - generic [ref=e267]:
                - generic:
                  - paragraph
              - generic [ref=e268]:
                - heading "Estilo Moderno y Vanguardista" [level=4] [ref=e269]
                - paragraph [ref=e270]: Combinando tecnología y diseño para destacar en cada recorrido
            - generic [ref=e273] [cursor=pointer]:
              - generic:
                - paragraph
            - generic [ref=e276] [cursor=pointer]:
              - generic:
                - paragraph
            - generic [ref=e279] [cursor=pointer]:
              - generic:
                - paragraph
        - generic [ref=e280]:
          - button [ref=e281] [cursor=pointer]
          - button [ref=e282] [cursor=pointer]
          - button [ref=e283] [cursor=pointer]
          - button [ref=e284] [cursor=pointer]
          - button [ref=e285] [cursor=pointer]
      - generic [ref=e287]:
        - heading "TOTALMENTE EQUIPADA Y VERSÁTIL" [level=2] [ref=e290]
        - generic [ref=e292]:
          - generic [ref=e293]:
            - generic [ref=e296] [cursor=pointer]:
              - generic:
                - paragraph
            - generic [ref=e299] [cursor=pointer]:
              - generic:
                - paragraph
          - generic [ref=e303]:
            - heading "Elegancia en Cada Detalle" [level=3] [ref=e304]
            - paragraph
            - paragraph [ref=e305]: Asientos de ecocuero que brindan comodidad y estilo
        - generic [ref=e306]:
          - button [ref=e307] [cursor=pointer]
          - button [ref=e308] [cursor=pointer]
          - button [ref=e309] [cursor=pointer]
      - generic [ref=e311]:
        - heading "SEGURIDAD INTEGRAL" [level=2] [ref=e314]
        - generic [ref=e316]:
          - generic [ref=e320]:
            - heading "Seguridad al Estacionar" [level=3] [ref=e321]
            - paragraph
            - paragraph [ref=e322]: Sensores traseros que cuidan cada maniobra.
          - generic [ref=e324] [cursor=pointer]:
            - generic [ref=e326]:
              - generic:
                - paragraph
            - generic [ref=e327]:
              - heading "Confianza en Cada Ruta" [level=4] [ref=e328]
              - paragraph [ref=e329]: Sistema de frenos ABS+EBD que responde cuando más lo necesitas.
        - generic [ref=e330]:
          - button [ref=e331] [cursor=pointer]
          - button [ref=e332] [cursor=pointer]
      - generic [ref=e334]:
        - heading "GALERÍA DE IMÁGENES" [level=2] [ref=e337]
        - generic [ref=e339]:
          - img "Interior detail" [ref=e342]
          - img "Seat detail" [ref=e345]
          - img "Grille detail" [ref=e348]
      - generic [ref=e352]:
        - img "GEELY" [ref=e354]
        - paragraph [ref=e356]: En Geely Bolivia, ofrecemos vehículos que combinan seguridad, tecnología avanzada y un diseño de vanguardia. Creemos que la movilidad de calidad debe ser una experiencia al alcance de todos. Es por eso que cada uno de nuestros autos está creado para quienes valoran la innovación, la eficiencia y las nuevas formas de moverse con libertad y confianza.
        - link "Descubre más" [ref=e358] [cursor=pointer]:
          - /url: https://global.geely.com/
      - generic [ref=e360]:
        - img "Test Drive" [ref=e362]
        - generic [ref=e365]:
          - heading "TEST DRIVE COOLRAY" [level=2] [ref=e366]
          - generic [ref=e367]:
            - paragraph [ref=e368]: Experimenta la eficiencia y versatilidad del Geely Coolray.
            - paragraph [ref=e369]: Agenda tu Test Drive ahora.
          - link "Agenda ahora" [ref=e370] [cursor=pointer]:
            - /url: /forms
      - generic [ref=e373]:
        - img "POSVENTA" [ref=e375]
        - generic [ref=e377]:
          - heading "POSVENTA" [level=2] [ref=e378]
          - paragraph [ref=e380]: En Geely, tu tranquilidad continúa después de la compra. Disfruta hasta 5 años de garantía, repuestos originales y un servicio técnico especializado que cuida tu vehículo como el primer día. Porque para nosotros, lo importante no es solo venderte un auto, sino acompañarte en cada kilómetro.
      - generic [ref=e385]:
        - img "Mapa de Bolivia" [ref=e388]
        - generic [ref=e389]:
          - generic [ref=e390]:
            - heading "DIRECCIONES" [level=2] [ref=e391]
            - paragraph [ref=e392]: "Encuentra la sucursal Geely más cercana:"
          - generic [ref=e393]:
            - generic [ref=e395]:
              - generic [ref=e396]:
                - heading "SANTA CRUZ" [level=3] [ref=e397]
                - generic [ref=e398]:
                  - paragraph [ref=e399]: Av. Doble Vía La Guardia N° 3325 Esq. Calle Rio Vilcas, entre 3er y 4to anillo
                  - paragraph
                  - paragraph
                  - paragraph [ref=e400]: Santa Cruz - Bolivia
              - link [ref=e402] [cursor=pointer]:
                - /url: https://maps.app.goo.gl/YQfPVMbUyNH6RjrU8
                - img [ref=e403]
            - generic [ref=e406]:
              - generic [ref=e407]:
                - heading "LA PAZ" [level=3] [ref=e408]
                - generic [ref=e409]:
                  - paragraph [ref=e410]: "Calacoto, Calle 15 esq. Roberto Prudencio #520"
                  - paragraph
                  - paragraph
                  - paragraph [ref=e411]: La Paz - Bolivia
              - link [ref=e413] [cursor=pointer]:
                - /url: https://maps.app.goo.gl/veuGtGn2iECCP9Ez8
                - img [ref=e414]
            - generic [ref=e417]:
              - generic [ref=e418]:
                - heading "El Alto" [level=3] [ref=e419]
                - generic [ref=e420]:
                  - paragraph [ref=e421]: Av. 6 de Marzo N° 1306 Frente Regimiento Ingavi
                  - paragraph
                  - paragraph
                  - paragraph [ref=e422]: El Alto - Bolivia
              - link [ref=e424] [cursor=pointer]:
                - /url: https://maps.app.goo.gl/veuGtGn2iECCP9Ez8
                - img [ref=e425]
            - generic [ref=e428]:
              - generic [ref=e429]:
                - heading "Cochabamba" [level=3] [ref=e430]
                - generic [ref=e431]:
                  - paragraph [ref=e432]: Av. Pando N° 1191, Recoleta
                  - paragraph
                  - paragraph
                  - paragraph [ref=e433]: Cochabamba - Bolivia
              - link [ref=e435] [cursor=pointer]:
                - /url: https://maps.app.goo.gl/veuGtGn2iECCP9Ez8
                - img [ref=e436]
            - generic [ref=e439]:
              - generic [ref=e440]:
                - heading "ORURO" [level=3] [ref=e441]
                - generic [ref=e442]:
                  - paragraph [ref=e443]: "Av. 6 de Agosto #853"
                  - paragraph
                  - paragraph
                  - paragraph [ref=e444]: Oruro - Bolivia
              - link [ref=e446] [cursor=pointer]:
                - /url: https://maps.app.goo.gl/DBPsGLxpBea5TroT6
                - img [ref=e447]
  - contentinfo [ref=e449]:
    - generic [ref=e451]:
      - generic [ref=e452]:
        - generic [ref=e453]:
          - generic [ref=e454]:
            - list
          - list [ref=e456]:
            - listitem [ref=e457]:
              - link "Acerca de nosotros" [ref=e458] [cursor=pointer]:
                - /url: https://www.geely.com/en/brand/see-the-world-in-full
            - listitem [ref=e459]:
              - link "Noticias" [ref=e460] [cursor=pointer]:
                - /url: https://global.geely.com/en/news
          - generic [ref=e461]:
            - list
        - generic [ref=e462]:
          - generic [ref=e464]:
            - generic [ref=e465]: "Oficina Corporativa:"
            - 'link "✉️ Av. Costanera # 1003, Los Pinos - La Paz, Bolivia" [ref=e466] [cursor=pointer]':
              - /url: "mailto:Av. Costanera # 1003, Los Pinos - La Paz, Bolivia"
              - generic [ref=e467]: ✉️
              - text: "Av. Costanera # 1003, Los Pinos - La Paz, Bolivia"
            - link "📞 (591)2-2795000" [ref=e468] [cursor=pointer]:
              - /url: tel:(591)2-2795000
              - generic [ref=e469]: 📞
              - text: (591)2-2795000
          - generic [ref=e470]:
            - link "Facebook" [ref=e471] [cursor=pointer]:
              - /url: https://www.facebook.com/profile.php?id=61579700183059
              - img [ref=e472]
            - link "Instagram" [ref=e474] [cursor=pointer]:
              - /url: https://www.instagram.com/geelybolivia
              - img [ref=e475]
            - link "YouTube" [ref=e477] [cursor=pointer]:
              - /url: http://www.youtube.com/@Geely.Bolivia
              - img [ref=e478]
            - link "TikTok" [ref=e480] [cursor=pointer]:
              - /url: https://www.tiktok.com/@geely.bo
              - img [ref=e481]
      - generic [ref=e485]:
        - link "Geely Bolivia" [ref=e486] [cursor=pointer]:
          - /url: /
          - img "Geely Bolivia" [ref=e487]
        - generic [ref=e488]: © 2025 Geely Bolivia
```

# Test source

```ts
  1   | import { test, expect, Page } from '@playwright/test';
  2   | import * as fs from 'fs';
  3   | import * as path from 'path';
  4   | import { PNG } from 'pngjs';
  5   | import pixelmatch from 'pixelmatch';
  6   | import { LOCAL, PROD, PAGES, SCREENSHOT_DIR, ensureDir } from './helpers';
  7   | 
  8   | const DIFF_THRESHOLD = 0.1;
  9   | 
  10  | // Increase timeout for prod pages (slow server)
  11  | test.setTimeout(60000);
  12  | 
  13  | /**
  14  |  * Wait for all Livewire components to mount, then scroll to bottom
  15  |  * to trigger lazy-loaded content, then scroll back to top.
  16  |  */
  17  | async function waitForFullRender(page: Page) {
  18  |   await page.waitForLoadState('networkidle');
  19  |   await page.waitForTimeout(2000);
  20  | 
  21  |   // Scroll to bottom in increments to trigger lazy loading
  22  |   await page.evaluate(async () => {
  23  |     const distance = 500;
  24  |     const totalHeight = document.body.scrollHeight;
  25  |     let current = 0;
  26  |     while (current < totalHeight) {
  27  |       current += distance;
  28  |       window.scrollTo(0, current);
  29  |       await new Promise(r => setTimeout(r, 150));
  30  |     }
  31  |     // Stay at bottom briefly
  32  |     window.scrollTo(0, document.body.scrollHeight);
  33  |   });
  34  |   await page.waitForTimeout(1500);
  35  | 
  36  |   // Wait for any new network requests triggered by scroll
  37  |   await page.waitForLoadState('networkidle');
  38  |   await page.waitForTimeout(500);
  39  | 
  40  |   // Scroll back to top
  41  |   await page.evaluate(() => window.scrollTo(0, 0));
  42  |   await page.waitForTimeout(500);
  43  | }
  44  | 
  45  | test.describe('Visual Regression: Prod vs Local', () => {
  46  |   for (const pg of PAGES) {
  47  |     test(`Screenshot comparison: ${pg.name}`, async ({ browser }) => {
  48  |       const prodDir = path.join(SCREENSHOT_DIR, 'prod');
  49  |       const localDir = path.join(SCREENSHOT_DIR, 'local');
  50  |       const diffDir = path.join(SCREENSHOT_DIR, 'diff');
  51  |       ensureDir(prodDir);
  52  |       ensureDir(localDir);
  53  |       ensureDir(diffDir);
  54  | 
  55  |       // Take prod screenshot
  56  |       const prodContext = await browser.newContext({
  57  |         viewport: { width: 1920, height: 1080 },
  58  |         ignoreHTTPSErrors: true,
  59  |       });
  60  |       const prodPage = await prodContext.newPage();
> 61  |       await prodPage.goto(`${PROD}${pg.path}`, { waitUntil: 'networkidle', timeout: 45000 });
      |                      ^ TimeoutError: page.goto: Timeout 45000ms exceeded.
  62  |       await waitForFullRender(prodPage);
  63  |       const prodScreenshot = await prodPage.screenshot({ fullPage: true });
  64  |       const prodPath = path.join(prodDir, `${pg.name}.png`);
  65  |       fs.writeFileSync(prodPath, prodScreenshot);
  66  |       await prodContext.close();
  67  | 
  68  |       // Take local screenshot
  69  |       const localContext = await browser.newContext({
  70  |         viewport: { width: 1920, height: 1080 },
  71  |         ignoreHTTPSErrors: true,
  72  |       });
  73  |       const localPage = await localContext.newPage();
  74  |       await localPage.goto(`${LOCAL}${pg.path}`, { waitUntil: 'networkidle', timeout: 30000 });
  75  |       await waitForFullRender(localPage);
  76  |       const localScreenshot = await localPage.screenshot({ fullPage: true });
  77  |       const localPath = path.join(localDir, `${pg.name}.png`);
  78  |       fs.writeFileSync(localPath, localScreenshot);
  79  |       await localContext.close();
  80  | 
  81  |       // Compare screenshots
  82  |       const prodImg = PNG.sync.read(prodScreenshot);
  83  |       const localImg = PNG.sync.read(localScreenshot);
  84  | 
  85  |       const width = Math.min(prodImg.width, localImg.width);
  86  |       const height = Math.min(prodImg.height, localImg.height);
  87  | 
  88  |       if (width > 0 && height > 0) {
  89  |         const croppedProd = cropPNG(prodImg, width, height);
  90  |         const croppedLocal = cropPNG(localImg, width, height);
  91  |         const diff = new PNG({ width, height });
  92  | 
  93  |         const numDiffPixels = pixelmatch(
  94  |           croppedProd.data,
  95  |           croppedLocal.data,
  96  |           diff.data,
  97  |           width,
  98  |           height,
  99  |           { threshold: DIFF_THRESHOLD }
  100 |         );
  101 | 
  102 |         const totalPixels = width * height;
  103 |         const diffPercent = ((numDiffPixels / totalPixels) * 100).toFixed(2);
  104 | 
  105 |         const diffPath = path.join(diffDir, `${pg.name}-diff.png`);
  106 |         fs.writeFileSync(diffPath, PNG.sync.write(diff));
  107 | 
  108 |         console.log(`  ${pg.name}: ${diffPercent}% different (${numDiffPixels}/${totalPixels} pixels)`);
  109 |         console.log(`    Prod size: ${prodImg.width}x${prodImg.height}`);
  110 |         console.log(`    Local size: ${localImg.width}x${localImg.height}`);
  111 | 
  112 |         if (parseFloat(diffPercent) > 30) {
  113 |           console.warn(`  ⚠️  High visual difference: ${diffPercent}%`);
  114 |         }
  115 |       }
  116 | 
  117 |       expect(prodScreenshot.length).toBeGreaterThan(1000);
  118 |       expect(localScreenshot.length).toBeGreaterThan(1000);
  119 |     });
  120 |   }
  121 | });
  122 | 
  123 | function cropPNG(img: PNG, width: number, height: number): PNG {
  124 |   const cropped = new PNG({ width, height });
  125 |   for (let y = 0; y < height; y++) {
  126 |     for (let x = 0; x < width; x++) {
  127 |       const srcIdx = (img.width * y + x) << 2;
  128 |       const dstIdx = (width * y + x) << 2;
  129 |       cropped.data[dstIdx] = img.data[srcIdx];
  130 |       cropped.data[dstIdx + 1] = img.data[srcIdx + 1];
  131 |       cropped.data[dstIdx + 2] = img.data[srcIdx + 2];
  132 |       cropped.data[dstIdx + 3] = img.data[srcIdx + 3];
  133 |     }
  134 |   }
  135 |   return cropped;
  136 | }
  137 | 
```