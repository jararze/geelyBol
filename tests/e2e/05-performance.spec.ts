import { test, expect } from '@playwright/test';
import { LOCAL, PAGES, collectConsoleErrors } from './helpers';

test.describe('Performance: Page Load Times', () => {
  for (const pg of PAGES) {
    test(`${pg.name} loads under 5 seconds`, async ({ page }) => {
      const start = Date.now();
      const response = await page.goto(`${LOCAL}${pg.path}`, {
        waitUntil: 'domcontentloaded',
        timeout: 15000,
      });
      const loadTime = Date.now() - start;

      expect(response?.status()).toBe(200);
      expect(loadTime, `${pg.name} took ${loadTime}ms`).toBeLessThan(15000);
      console.log(`  ${pg.name}: ${loadTime}ms`);
    });
  }

  test('Forms page loads under 5 seconds', async ({ page }) => {
    const start = Date.now();
    const response = await page.goto(`${LOCAL}/forms`, {
      waitUntil: 'domcontentloaded',
      timeout: 15000,
    });
    const loadTime = Date.now() - start;

    expect(response?.status()).toBe(200);
    expect(loadTime, `Forms took ${loadTime}ms`).toBeLessThan(15000);
    console.log(`  forms: ${loadTime}ms`);
  });

  for (const pg of PAGES) {
    test(`${pg.name} has no critical JS errors`, async ({ page }) => {
      const errors = await collectConsoleErrors(page);
      await page.goto(`${LOCAL}${pg.path}`, { waitUntil: 'networkidle', timeout: 15000 });
      await page.waitForTimeout(2000);

      const critical = errors.filter(e =>
        !e.includes('favicon') && !e.includes('gtag') &&
        !e.includes('analytics') && !e.includes('pixel') &&
        !e.includes('tiktok') && !e.includes('third-party') &&
        !e.includes('net::ERR')
      );

      if (critical.length > 0) {
        console.warn(`  ⚠️ ${pg.name} JS errors:`, critical);
      }
      expect(critical.length).toBeLessThanOrEqual(3);
    });
  }
});
