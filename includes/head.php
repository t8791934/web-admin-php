<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />
<link href="css/styles.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js" defer></script>
<?php $websiteTitle = '後台管理系統'; ?>

<?php if (!isset($auth_checked)): ?>
  <script>
    alert([
      `Warning: This page is available to unauthorized users!`,
      `add: require 'includes/authorize.php'; to authorize,`,
      `set: $auth_checked = true; if this page doesn't need to be authorized.`,
    ].join('\n'));
  </script>
<?php endif; ?>
