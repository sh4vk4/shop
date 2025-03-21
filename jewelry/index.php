<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="../media/icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style/style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css" media="all" />    <link
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css"
      rel="stylesheet"
    />
    <title>jewelry</title>
  </head>
  <body>
    <? include '../php/header.php'; ?>
    <main class="wrap">
    <div class="container">
      <ul class="sidebar">
        <? $category = "Jewelry";?>
        <details>
          <summary><h3>Type<i class='bx bxl-slack-old' ></i></h3></summary>
          <ul>
            <? include '../php/item_type.php'; ?>
          </ul>
        </details>
        <hr>
        <h3>Filter by<i class='bx bx-filter'></i></h3>
        <li><label for="rating"><input class="selector filter-rating" type="checkbox" name="rating" id="rating">Good rating<span class="checkmark"><i class="bx bx-check"></i></span></label></li>
        <li><label for="reviews"><input class="selector filter-reviews" type="checkbox" name="reviews" id="reviews">Has reviews<span class="checkmark"><i class="bx bx-check"></i></span></label></li>
        <li><label for="discount"><input class="selector filter-discount" type="checkbox" name="discount" id="discount">Discount<span class="checkmark"><i class="bx bx-check"></i></span></label></li>
        <hr>
        <h3>Price<i class='bx bxs-purchase-tag' ></i></h3>
          <li>
            <div class="price-range-block">
                    <div id="slider-range" class="price-filter-range" name="rangeInput"></div>
                    <div style="margin:30px auto">
                      <input type="number" min="5" max="45" oninput="validity.valid||(value='5');" id="min_price" class="price-range-field" />
                      -
                      <input type="number" min=0 max="50" oninput="validity.valid||(value='50');" id="max_price" class="price-range-field" />
                    </div>
            </div>
          </li>
      </ul>
      </div>
      <section class="productlist" id="searchResults">
        <? include '../php/item_card.php'; ?>
      </section>
    </main>
    <footer>
        
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js" integrity="sha512-Ww1y9OuQ2kehgVWSD/3nhgfrb424O3802QYP/A5gPXoM4+rRjiKrjHdGxQKrMGQykmsJ/86oGdHszfcVgUr4hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>
</html>

<script src="../js/script.js"></script>

<script>

var category = 'Jewelry';

</script>