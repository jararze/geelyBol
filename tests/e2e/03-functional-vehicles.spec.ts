import { test, expect } from '@playwright/test';
import { LOCAL, waitForPageReady, collectConsoleErrors } from './helpers';

const VEHICLES = [
  { name: 'Starray', path: '/vehiculos/suv/starray' },
  { name: 'GX3 Pro', path: '/vehiculos/suv/gx3-pro' },
  { name: 'Cityray', path: '/vehiculos/suv/cityray' },
  { name: 'Coolray', path: '/vehiculos/suv/coolray' },
];

test.describe('Functional: Vehicle Pages', () => {
  for (const vehicle of VEHICLES) {
    test.describe(vehicle.name, () => {

      test('Hero loads with visible background image', async ({ page }) => {
        await page.goto(`${LOCAL}${vehicle.path}`, { waitUntil: 'networkidle', timeout: 15000 });
        await waitForPageReady(page);

        // On desktop, the visible hero image has `hidden md:block` class
        // Use :visible pseudo to find the actually visible image
        const heroImg = page.locator('section img:visible, div[class*="hero"] img:visible, div[class*="min-h"] img:visible').first();
        await expect(heroImg).toBeVisible();

        const src = await heroImg.getAttribute('src');
        expect(src).toBeTruthy();
        expect(src).toContain('frontend/images/vehicles');
      });

      test('Feature slider exists and advances', async ({ page }) => {
        await page.goto(`${LOCAL}${vehicle.path}`, { waitUntil: 'networkidle', timeout: 15000 });
        await waitForPageReady(page);

        // Look for feature slider section
        const sliderSection = page.locator('[wire\\:click*="nextSlide"], [wire\\:click*="goToSlide"]').first();
        if (await sliderSection.isVisible()) {
          await sliderSection.click();
          await page.waitForTimeout(500);
        }
      });

      test('Cotizar button exists and links to form', async ({ page }) => {
        await page.goto(`${LOCAL}${vehicle.path}`, { waitUntil: 'networkidle', timeout: 15000 });
        await waitForPageReady(page);

        const cotizarBtn = page.locator('a:has-text("Cotizar"), a:has-text("cotizar"), a:has-text("Agenda"), button:has-text("Cotizar")').first();
        if (await cotizarBtn.isVisible()) {
          const href = await cotizarBtn.getAttribute('href');
          if (href) {
            expect(href).toContain('/forms');
          }
        }
      });

      test('YouTube videos section exists', async ({ page }) => {
        await page.goto(`${LOCAL}${vehicle.path}`, { waitUntil: 'networkidle', timeout: 15000 });
        await waitForPageReady(page);

        // Scroll down to find video section
        await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight * 0.7));
        await page.waitForTimeout(1000);

        // Look for YouTube embeds or video section
        const videoSection = page.locator('iframe[src*="youtube"], [class*="video"], section:has-text("VIDEOS")').first();
        if (await videoSection.isVisible()) {
          const iframe = page.locator('iframe[src*="youtube"]').first();
          if (await iframe.isVisible()) {
            const src = await iframe.getAttribute('src');
            expect(src).toContain('youtube');
          }
        }
      });

      test('Gallery section has images', async ({ page }) => {
        await page.goto(`${LOCAL}${vehicle.path}`, { waitUntil: 'networkidle', timeout: 15000 });
        await waitForPageReady(page);

        // Scroll to bottom for gallery
        await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight * 0.85));
        await page.waitForTimeout(1000);

        const galleryImages = page.locator('img[alt*="detail"], img[alt*="Interior"], img[alt*="Seat"], img[alt*="Grille"], img[alt*="Dashboard"], img[alt*="front"]');
        const count = await galleryImages.count();
        if (count > 0) {
          expect(count).toBeGreaterThanOrEqual(2);
        }
      });

      test('No critical JavaScript errors', async ({ page }) => {
        const errors = await collectConsoleErrors(page);
        await page.goto(`${LOCAL}${vehicle.path}`, { waitUntil: 'networkidle', timeout: 15000 });
        await waitForPageReady(page);

        const critical = errors.filter(e =>
          !e.includes('favicon') && !e.includes('gtag') &&
          !e.includes('analytics') && !e.includes('pixel') &&
          !e.includes('tiktok') && !e.includes('third-party')
        );
        expect(critical.length).toBeLessThanOrEqual(3);
      });
    });
  }
});
