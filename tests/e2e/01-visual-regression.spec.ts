import { test, expect, Page } from '@playwright/test';
import * as fs from 'fs';
import * as path from 'path';
import { PNG } from 'pngjs';
import pixelmatch from 'pixelmatch';
import { LOCAL, PROD, PAGES, SCREENSHOT_DIR, ensureDir } from './helpers';

const DIFF_THRESHOLD = 0.1;

// Increase timeout for prod pages (slow server)
test.setTimeout(60000);

/**
 * Wait for all Livewire components to mount, then scroll to bottom
 * to trigger lazy-loaded content, then scroll back to top.
 */
async function waitForFullRender(page: Page) {
  await page.waitForLoadState('networkidle');
  await page.waitForTimeout(2000);

  // Scroll to bottom in increments to trigger lazy loading
  await page.evaluate(async () => {
    const distance = 500;
    const totalHeight = document.body.scrollHeight;
    let current = 0;
    while (current < totalHeight) {
      current += distance;
      window.scrollTo(0, current);
      await new Promise(r => setTimeout(r, 150));
    }
    // Stay at bottom briefly
    window.scrollTo(0, document.body.scrollHeight);
  });
  await page.waitForTimeout(1500);

  // Wait for any new network requests triggered by scroll
  await page.waitForLoadState('networkidle');
  await page.waitForTimeout(500);

  // Scroll back to top
  await page.evaluate(() => window.scrollTo(0, 0));
  await page.waitForTimeout(500);
}

test.describe('Visual Regression: Prod vs Local', () => {
  for (const pg of PAGES) {
    test(`Screenshot comparison: ${pg.name}`, async ({ browser }) => {
      const prodDir = path.join(SCREENSHOT_DIR, 'prod');
      const localDir = path.join(SCREENSHOT_DIR, 'local');
      const diffDir = path.join(SCREENSHOT_DIR, 'diff');
      ensureDir(prodDir);
      ensureDir(localDir);
      ensureDir(diffDir);

      // Take prod screenshot
      const prodContext = await browser.newContext({
        viewport: { width: 1920, height: 1080 },
        ignoreHTTPSErrors: true,
      });
      const prodPage = await prodContext.newPage();
      await prodPage.goto(`${PROD}${pg.path}`, { waitUntil: 'networkidle', timeout: 45000 });
      await waitForFullRender(prodPage);
      const prodScreenshot = await prodPage.screenshot({ fullPage: true });
      const prodPath = path.join(prodDir, `${pg.name}.png`);
      fs.writeFileSync(prodPath, prodScreenshot);
      await prodContext.close();

      // Take local screenshot
      const localContext = await browser.newContext({
        viewport: { width: 1920, height: 1080 },
        ignoreHTTPSErrors: true,
      });
      const localPage = await localContext.newPage();
      await localPage.goto(`${LOCAL}${pg.path}`, { waitUntil: 'networkidle', timeout: 30000 });
      await waitForFullRender(localPage);
      const localScreenshot = await localPage.screenshot({ fullPage: true });
      const localPath = path.join(localDir, `${pg.name}.png`);
      fs.writeFileSync(localPath, localScreenshot);
      await localContext.close();

      // Compare screenshots
      const prodImg = PNG.sync.read(prodScreenshot);
      const localImg = PNG.sync.read(localScreenshot);

      const width = Math.min(prodImg.width, localImg.width);
      const height = Math.min(prodImg.height, localImg.height);

      if (width > 0 && height > 0) {
        const croppedProd = cropPNG(prodImg, width, height);
        const croppedLocal = cropPNG(localImg, width, height);
        const diff = new PNG({ width, height });

        const numDiffPixels = pixelmatch(
          croppedProd.data,
          croppedLocal.data,
          diff.data,
          width,
          height,
          { threshold: DIFF_THRESHOLD }
        );

        const totalPixels = width * height;
        const diffPercent = ((numDiffPixels / totalPixels) * 100).toFixed(2);

        const diffPath = path.join(diffDir, `${pg.name}-diff.png`);
        fs.writeFileSync(diffPath, PNG.sync.write(diff));

        console.log(`  ${pg.name}: ${diffPercent}% different (${numDiffPixels}/${totalPixels} pixels)`);
        console.log(`    Prod size: ${prodImg.width}x${prodImg.height}`);
        console.log(`    Local size: ${localImg.width}x${localImg.height}`);

        if (parseFloat(diffPercent) > 30) {
          console.warn(`  ⚠️  High visual difference: ${diffPercent}%`);
        }
      }

      expect(prodScreenshot.length).toBeGreaterThan(1000);
      expect(localScreenshot.length).toBeGreaterThan(1000);
    });
  }
});

function cropPNG(img: PNG, width: number, height: number): PNG {
  const cropped = new PNG({ width, height });
  for (let y = 0; y < height; y++) {
    for (let x = 0; x < width; x++) {
      const srcIdx = (img.width * y + x) << 2;
      const dstIdx = (width * y + x) << 2;
      cropped.data[dstIdx] = img.data[srcIdx];
      cropped.data[dstIdx + 1] = img.data[srcIdx + 1];
      cropped.data[dstIdx + 2] = img.data[srcIdx + 2];
      cropped.data[dstIdx + 3] = img.data[srcIdx + 3];
    }
  }
  return cropped;
}
