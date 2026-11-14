<?php
require '../portalite.php';
$logo = pl_config('index.logo', null);
$logoWidth = $logo === null ? null : pl_get($logo, 'width');
$logoHeight = $logo === null ? null : pl_get($logo, 'height');
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

    @media (max-width: 600px) {
      .header-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .header-content::before,
      .header-content::after {
        display: none;
      }

      .header-content .w3-cell {
        display: block;
        text-align: center;
      }
    }
    </style>
  </head>
  <body class="w3-secondary">
    <header class="w3-padding-16 w3-primary">
      <div class="w3-content w3-cell-row header-content">
        <?php if ($logo !== null): ?>
				<div class="w3-cell w3-cell-middle w3-padding">
					<img src="<?= pl_get($logo, 'url') ?>"
          <?php if ($logoWidth !== null): ?> width="<?= $logoWidth ?>"<?php endif; ?>
          <?php if ($logoHeight !== null): ?> height="<?= $logoHeight ?>"<?php endif; ?> />
				</div>
        <?php endif; ?>
				<div class="w3-cell w3-cell-middle w3-padding">
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
  </body>
</html>