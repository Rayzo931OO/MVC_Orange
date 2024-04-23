
<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="stylesheet" href="/style.css" />
   <title>
      <?= $title ?>
   </title>
   <link href="/global.css" rel="stylesheet" />

   <link href="/templates/style.css" rel="stylesheet" />
</head>

<body>
   <div class="body">

      <?php require(__DIR__ . '/header/header.php'); ?>
      <?php var_dump(__DIR__) ?>
      <main>
         <div class="main__container">
            <h1><?= $h1 ?></h1>
            <div class="main__container__wrapper <?= isset($isSidebar)? $isSidebar : ''; ?>">
               <?php isset($isSidebar) && require(__DIR__ . '/sidebar/index.php'); ?>
               <div class="main__container__wrapper__content">
                  <?= $content ?>
               </div>
            </div>
         </div>
      </main>
   </div>
   <?php require(__DIR__ . '/footer/footer.php'); ?>
</body>

</html>