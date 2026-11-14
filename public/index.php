<?php
require '../portalite.php';
$logo = pl_config('index.logo', null);
$logoWidth = $logo === null ? null : pl_get($logo, 'width');
$logoHeight = $logo === null ? null : pl_get($logo, 'height');
$footer = pl_config('footer', []);
$footerGroups = [];
foreach (['left', 'middle', 'right'] as $position) {
    if (array_key_exists($position, $footer)) {
        $footerGroups[$position] = $footer[$position];
    }
}
$footerLow = array_key_exists('low', $footer) ? $footer['low'] : null;
$footerLowLinks = $footerLow === null ? [] : pl_get($footerLow, 'links', []);
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?= pl_config('index.title', 'PortaLite') ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="<?= pl_config('index.robots', 'noindex, nofollow') ?>" />
    <link rel="stylesheet" href="/css/w3.css">
    <style>
    span, p {
      font-size: 15px;
      color: <?= pl_config('index.colors.text.textOnSecondary', '#888888') ?>
    }

    .w3-white {
      background: #ffffff;
    }

    .w3-emphasis {
      color: <?= pl_config('index.colors.text.headlineEmphasis', '#112211') ?>
    }
    
    .w3-primary {
      background: <?= pl_config('index.colors.background.primary', '#008c99') ?>;
      color: <?= pl_config('index.colors.text.textOnPrimary', '#ffffff') ?>;
    }

    .w3-secondary {
      background: <?= pl_config('index.colors.background.secondary', '#cccccc') ?>;
      color: <?= pl_config('index.colors.text.textOnSecondary', '#112211') ?>;
    }

    .w3-accent {
      background: <?= pl_config('index.colors.background.accent', '#99cc04') ?>;
      color: <?= pl_config('index.colors.text.textOnAccent', '#ffffff') ?>;
    }

    .header-content {
      display: flex;
      align-items: center;
    }

    .footer-content {
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 16px;
    }

    .footer-group-left {
      grid-column: 1;
    }

    .footer-group-middle {
      grid-column: 2;
    }

    .footer-group-right {
      grid-column: 3;
    }

    .footer-links {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .footer-title {
      margin: 0 0 8px;
    }

    .footer-links li + li {
      margin-top: 8px;
    }

    .footer-links a {
      color: inherit;
      text-decoration: none;
    }

    .footer-low {
      padding: 8px 16px;
    }

    .footer-low-content {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 8px 16px;
    }

    .footer-low a {
      color: inherit;
      text-decoration: none;
    }

    @media (max-width: 600px) {
      .header-content {
        flex-direction: column;
        text-align: center;
      }

      .footer-content {
        grid-template-columns: 1fr;
      }

      .footer-group-left,
      .footer-group-middle,
      .footer-group-right {
        grid-column: auto;
      }

      .footer-group {
        padding: 8px 16px;
      }

      body.has-footer-low {
        padding-bottom: 80px;
      }

      .footer-low {
        position: fixed;
        right: 16px;
        bottom: 16px;
        left: 16px;
        z-index: 100;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      }

    }
    </style>
  </head>
  <body class="w3-secondary<?= count($footerLowLinks) > 0 ? ' has-footer-low' : '' ?>">
    <header class="w3-padding-16 w3-primary">
      <div class="w3-content header-content">
        <?php if ($logo !== null): ?>
				<div class="w3-padding">
					<img src="<?= pl_get($logo, 'url') ?>"
          <?php if ($logoWidth !== null): ?> width="<?= $logoWidth ?>"<?php endif; ?>
          <?php if ($logoHeight !== null): ?> height="<?= $logoHeight ?>"<?php endif; ?> />
				</div>
        <?php endif; ?>
				<div class="w3-padding">
					<h1><?= pl_config('index.title', 'PortaLite') ?></h1>
				</div>
			</div>
    </header>
    <main class="w3-main w3-content w3-padding-32">
      <?php if (pl_config('index.subtitle') !== null || pl_config('index.description') !== null): ?>
			<div class="w3-container w3-medium w3-center">
        <?php if (pl_config('index.subtitle') !== null): ?>
				<h2 class="w3-emphasis" style="font-size:34px;font-weight:800;"><?= pl_config('index.subtitle') ?></h2>
        <?php endif; ?>
        <?php if (pl_config('index.description') !== null): ?>
				<p><?= pl_config('index.description') ?></p>
        <?php endif; ?>
        <div class="w3-padding-16"></div>
      </div>
      <?php endif; ?>
      <?php if (count(pl_config('index.groups', [])) > 0): ?>
        <?php foreach (pl_config('index.groups') as $group): ?>
        <div class="w3-white w3-card w3-round w3-padding" style="margin-top:16px;">
          <?php if (pl_get($group, 'title') !== null): ?>
          <h3 style="font-weight:600;"><?= pl_get($group, 'title') ?></h3>
          <?php endif; ?>
          <?php if (pl_get($group, 'description') !== null): ?>
          <p><?= pl_get($group, 'description') ?></p>
          <?php endif; ?>
          <?php if (count(pl_get($group, 'entries', [])) > 0): ?>
            <?php foreach (pl_get($group, 'entries') as $entry): ?>
            <div class="w3-row w3-container w3-medium" style="margin:32px 0px;">
              <div class="w3-threequarter"<?= pl_get($entry, 'description', null) === null ? ' style="padding: 12px 0px;"' : null ?>>
                <span>
                  <b class="w3-emphasis"><?= pl_get($entry, 'title') ?></b>
                  <?php if (pl_get($entry, 'description') !== null): ?>
                  <br /><?= pl_get($entry, 'description') ?>
                  <?php endif; ?>
                </span>
              </div>
              <div class="w3-quarter">
                <div class="w3-mobile w3-right">
                <?php foreach (pl_get($entry, 'links', []) as $link): ?>
                  <a class="w3-button w3-accent w3-round-large w3-mobile w3-disabled" style="margin: 4px 0px;" data-url="<?= pl_get($link, 'url') ?>" target="<?= pl_get($link, 'target') ?>" aria-disabled="true" tabindex="-1"><b><?= pl_get($link, 'title') ?></b></a>
                <?php endforeach; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </main>
    <script>
      document.querySelectorAll('a.w3-button[data-url]').forEach(function (button) {
        var controller = new AbortController();

        fetch(button.dataset.url, { cache: 'no-store', signal: controller.signal })
          .then(function (response) {
            if (response.status === 200) {
              button.href = button.dataset.url;
              button.classList.remove('w3-disabled');
              button.removeAttribute('aria-disabled');
              button.removeAttribute('tabindex');
            }

            controller.abort();
          })
          .catch(function (error) {
            console.warn('Unable to check link "' + button.dataset.url + '":', error);
          });
      });
    </script>
    <?php if (count($footerGroups) > 0): ?>
    <footer class="w3-secondary w3-padding-16">
      <div class="w3-content footer-content">
        <?php foreach ($footerGroups as $position => $group): ?>
        <section class="footer-group footer-group-<?= $position ?>">
          <?php if (pl_get($group, 'title') !== null): ?>
          <h3 class="footer-title"><?= pl_get($group, 'title') ?></h3>
          <?php endif; ?>
          <ul class="footer-links">
            <?php foreach (pl_get($group, 'links', []) as $link): ?>
            <li><a href="<?= pl_get($link, 'url') ?>" target="<?= pl_get($link, 'target', '_self') ?>"><?= pl_get($link, 'title') ?></a></li>
            <?php endforeach; ?>
          </ul>
        </section>
        <?php endforeach; ?>
      </div>
    </footer>
    <?php endif; ?>
    <?php if (count($footerLowLinks) > 0): ?>
    <div class="footer-low w3-secondary">
      <div class="w3-content footer-low-content">
        <?php foreach ($footerLowLinks as $link): ?>
        <a href="<?= pl_get($link, 'url') ?>" target="<?= pl_get($link, 'target', '_self') ?>"><?= pl_get($link, 'title') ?></a>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </body>
</html>