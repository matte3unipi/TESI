const puppeteer = require('puppeteer-core');

const TARGET_URL = process.env.TARGET_URL || 'http://web/index.php';
const COOKIE = process.env.FLAG || 'FLAG{default_flag}';
const VISIT_INTERVAL_MS = parseInt(process.env.INTERVAL || '15000'); // every 15s

async function visitPage() {
    let browser;
    try {
        browser = await puppeteer.launch({
            headless: true,
            executablePath: '/usr/bin/chromium',
            args: [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-dev-shm-usage',
                '--disable-gpu',
            ]
        });

        const page = await browser.newPage();
        page.on('dialog', async dialog => {
            console.log(`[${new Date().toISOString()}] Bot dismissing dialog: ${dialog.message()}`);
            await dialog.dismiss();
        });

        // Set cookie con le credenziali dell'admin (FLAG) prima di visitare la pagina
        await page.setCookie({
            name: 'session',
            value: COOKIE,
            domain: 'web',
            path: '/',
            httpOnly: false,  // Deve essere accessibile da JavaScript per essere inviata con le richieste
        });

        console.log(`[${new Date().toISOString()}] Bot visiting: ${TARGET_URL}`);
        await page.goto(TARGET_URL, { waitUntil: 'networkidle2', timeout: 10000 });


        // Versione in cui gestisco correttamente anche i link normali (extra)
        const hrefs = await page.$$eval('a', anchors => anchors.map(a => a.href));

        for (let i = 0; i < hrefs.length; i++) {
            console.log(`[${new Date().toISOString()}] Bot clicking link: ${hrefs[i]}`);

            if (hrefs[i].startsWith('javascript:')) {
                await page.evaluate(el => el.dispatchEvent(new MouseEvent('click')), await page.$(`a[href="${hrefs[i]}"]`));
                await new Promise(r => setTimeout(r, 3000));
            } else {
                await page.goto(hrefs[i], { waitUntil: 'networkidle2', timeout: 10000 });
            }
        }

        console.log(`[${new Date().toISOString()}] Bot visit complete.`);

    } catch (err) {
        console.error(`[${new Date().toISOString()}] Bot error: ${err.message}`);
    } finally {
        if (browser) await browser.close();
    }
}


visitPage();
setInterval(visitPage, VISIT_INTERVAL_MS);