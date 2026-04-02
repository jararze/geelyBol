import { Page } from '@playwright/test';
import * as fs from 'fs';
import * as path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export const LOCAL = 'https://geely-site.test';
export const PROD = 'https://geely.com.bo';

export const PAGES = [
  { name: 'homepage', path: '/' },
  { name: 'starray', path: '/vehiculos/suv/starray' },
  { name: 'gx3-pro', path: '/vehiculos/suv/gx3-pro' },
  { name: 'cityray', path: '/vehiculos/suv/cityray' },
  { name: 'coolray', path: '/vehiculos/suv/coolray' },
];

export const SCREENSHOT_DIR = path.join(__dirname, '..', 'screenshots');

export async function waitForPageReady(page: Page) {
  await page.waitForLoadState('networkidle');
  // Extra wait for Livewire/lazy images
  await page.waitForTimeout(2000);
}

export async function collectConsoleErrors(page: Page): Promise<string[]> {
  const errors: string[] = [];
  page.on('console', msg => {
    if (msg.type() === 'error') {
      const text = msg.text();
      // Ignore common non-critical errors
      if (text.includes('favicon') || text.includes('ERR_BLOCKED_BY_CLIENT') || text.includes('net::ERR')) return;
      errors.push(text);
    }
  });
  return errors;
}

export function ensureDir(dir: string) {
  if (!fs.existsSync(dir)) {
    fs.mkdirSync(dir, { recursive: true });
  }
}
