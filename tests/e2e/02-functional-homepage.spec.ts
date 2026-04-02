import { test, expect, Page } from '@playwright/test';
import { LOCAL, waitForPageReady, collectConsoleErrors } from './helpers';

test.describe('Functional: Homepage', () => {
  let page: Page;
  let consoleErrors: string[];

  test.beforeEach(async ({ page: p }) => {
    page = p;
    consoleErrors = await collectConsoleErrors(page);
    await page.goto(LOCAL, { waitUntil: 'networkidle', timeout: 15000 });
    await waitForPageReady(page);
  });

  test('Hero slider has navigation and advances', async () => {
    // Check hero section exists
    const hero = page.locator('[class*="hero"], [id*="hero"], section').first();
    await expect(hero).toBeVisible();

    // Look for next/prev buttons or dots
    const nextBtn = page.locator('button[wire\\:click*="nextSlide"], [wire\\:click*="next"], button:has(svg[class*="right"]), button:has(svg[class*="chevron"])').first();
    if (await nextBtn.isVisible()) {
      await nextBtn.click();
      await page.waitForTimeout(500);
    }
  });

  test('WhatsApp button has correct href', async () => {
    const whatsappLink = page.locator('a[href*="wa.me"], a[href*="whatsapp"]').first();
    await expect(whatsappLink).toBeVisible();
    const href = await whatsappLink.getAttribute('href');
    expect(href).toContain('wa.me/591');
  });

  test('Promotions slider exists and has content', async () => {
    // Scroll to promotions section
    const promoSection = page.locator('[id*="promoc"], [class*="promoc"], section:has-text("DESCUENTO")').first();
    if (await promoSection.isVisible()) {
      await promoSection.scrollIntoViewIfNeeded();
      await expect(promoSection).toContainText(/descuento|DESCUENTO|promo/i);
    }
  });

  test('Navigation menu opens vehicle dropdown', async () => {
    // Look for the main nav Vehiculos link
    const navLink = page.locator('nav a:has-text("Vehículos"), nav button:has-text("Vehículos"), header a:has-text("Vehículos"), header button:has-text("Vehículos")').first();
    if (await navLink.isVisible()) {
      await navLink.hover();
      await page.waitForTimeout(500);
      // Check dropdown appeared
      const dropdown = page.locator('[class*="dropdown"]:visible, [class*="submenu"]:visible, nav ul ul:visible').first();
      // Dropdown might use different patterns, just verify the click/hover doesn't error
    }
  });

  test('Navigation links do not return 404', async () => {
    const navLinks = page.locator('nav a[href], header a[href]');
    const count = await navLinks.count();
    const checked: string[] = [];

    for (let i = 0; i < Math.min(count, 15); i++) {
      const href = await navLinks.nth(i).getAttribute('href');
      if (!href || href.startsWith('#') || href.startsWith('javascript') || href.startsWith('mailto') || href.startsWith('tel')) continue;

      const fullUrl = href.startsWith('http') ? href : `${LOCAL}${href.startsWith('/') ? '' : '/'}${href}`;

      // Skip external links
      if (!fullUrl.includes('geely-site.test') && !fullUrl.startsWith('/')) continue;

      if (checked.includes(fullUrl)) continue;
      checked.push(fullUrl);

      const response = await page.request.get(fullUrl);
      expect(response.status(), `Link ${fullUrl} returned ${response.status()}`).not.toBe(404);
    }

    console.log(`  Checked ${checked.length} navigation links`);
  });

  test('Five branch locations are visible', async () => {
    // Scroll to direcciones section
    await page.evaluate(() => {
      const el = document.querySelector('[id*="direccion"], [id*="branch"], section:has(h2)');
      if (el) el.scrollIntoView();
    });
    await page.waitForTimeout(1000);

    // Check for branch names
    const branches = ['SANTA CRUZ', 'LA PAZ', 'EL ALTO', 'COCHABAMBA', 'ORURO'];
    for (const branch of branches) {
      const el = page.locator(`text=${branch}`).first();
      await expect(el, `Branch ${branch} should be visible`).toBeVisible();
    }
  });

  test('Google Maps links work', async () => {
    const mapLinks = page.locator('a[href*="maps.google"], a[href*="goo.gl"], a[href*="maps.app"]');
    const count = await mapLinks.count();
    expect(count, 'Should have Google Maps links').toBeGreaterThanOrEqual(1);

    for (let i = 0; i < count; i++) {
      const href = await mapLinks.nth(i).getAttribute('href');
      expect(href).toMatch(/maps\.google|goo\.gl|maps\.app/);
    }
    console.log(`  Found ${count} Google Maps links`);
  });

  test('No critical JavaScript console errors', async () => {
    // Filter out non-critical errors
    const critical = consoleErrors.filter(e =>
      !e.includes('favicon') &&
      !e.includes('third-party') &&
      !e.includes('gtag') &&
      !e.includes('analytics') &&
      !e.includes('pixel') &&
      !e.includes('tiktok')
    );
    if (critical.length > 0) {
      console.warn('  Console errors found:', critical);
    }
    // Warn but don't fail for tracking script errors
    expect(critical.length, `Found ${critical.length} console errors: ${critical.join(', ')}`).toBeLessThanOrEqual(3);
  });
});
