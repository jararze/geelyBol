import { test, expect } from '@playwright/test';
import { LOCAL, waitForPageReady } from './helpers';

test.describe('Functional: Contact Form', () => {

  test('Form page loads with required fields', async ({ page }) => {
    await page.goto(`${LOCAL}/forms`, { waitUntil: 'networkidle', timeout: 15000 });
    await waitForPageReady(page);

    // The form uses wire:model attributes - look for those
    const nameField = page.locator('input[wire\\:model*="nombre"], input[wire\\:model*="name"]').first();
    await expect(nameField, 'Name field should exist').toBeAttached();

    const emailField = page.locator('input[wire\\:model*="email"]').first();
    await expect(emailField, 'Email field should exist').toBeAttached();

    const phoneField = page.locator('input[wire\\:model*="celular"], input[wire\\:model*="telefono"], input[wire\\:model*="phone"]').first();
    await expect(phoneField, 'Phone field should exist').toBeAttached();

    // Verify the form tab titles are visible
    await expect(page.locator('text=TEST DRIVE').first()).toBeVisible();
    await expect(page.locator('text=COTIZACIÓN').first()).toBeVisible();
  });

  test('Vehicle-specific form loads correctly', async ({ page }) => {
    await page.goto(`${LOCAL}/forms/suv/starray`, { waitUntil: 'networkidle', timeout: 15000 });
    await waitForPageReady(page);

    const pageContent = await page.textContent('body');
    expect(pageContent).toBeTruthy();
    expect(pageContent!.length).toBeGreaterThan(100);
  });

  test('Form submit button exists', async ({ page }) => {
    await page.goto(`${LOCAL}/forms`, { waitUntil: 'networkidle', timeout: 15000 });
    await waitForPageReady(page);

    const submitBtn = page.locator('button[type="submit"]').first();
    await expect(submitBtn).toBeAttached();

    // Verify button text
    const text = await submitBtn.textContent();
    expect(text?.trim()).toMatch(/enviar/i);
  });
});
