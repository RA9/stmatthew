<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?php if(isset($title)){
            echo $title;
        }
        ?>
    </title>

    <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="vendor/css/sb-admin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="vendor/bootstrap/css/style.css" rel="stylesheet">
    <style>
      /* body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      } */

  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }

 .danger {
    color: red;
    font-size: 24px;
 }

 .error {
  width: 92%;
  margin: 0px auto;
  padding: 10px;
  border: 1px solid #a94442;
  color: #a94442;
  background: #f2dede;
  border-radius: 5px;
  text-align: left;
}



    </style>

  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">
