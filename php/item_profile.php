<?

    

echo '
    <div class="product-image">
        <div class="product-image__item hover-scaleup" style="background-image: url(' . $row['productMainPhoto'] . ');">
          <form action="fav_actions.php" method="post">
            <button type="submit" name="addToFav">
              <i class="bx bx-bookmark"></i>
            </button>
          </form>
        </div>
        <div class="product-image__gallery">
            <div class="preview hover-scaleup" style="background-image: url(' . $row['productMainPhoto'] . ');"></div>';
            include('item_gallery.php'); 
echo '  </div>
    </div>
    <div class="product-info">
        <div class="product-info__title">
            <h1>' . $row['productName'] . ' ' . $row['typeName'] . '</h1>';
            require 'item_reviews.php';
echo    '
        </div>
        <div class="desc">
            <ul>
              <li class="line">
                <p>Product</p>
                <p>Notebook</p>
              </li>
              <li class="line">
                <p>Material</p>
                <p>Good Paper</p>
              </li>
              <li class="line">
                <p>Something</p>
                <p>Something</p>
              </li>
              <li class="line">
                <p>PeePee</p>
                <p>PooPoo</p>
              </li>
              <li class="line">
                <p>Ass</p>
                <p>Tits</p>
              </li>
            </ul>
        </div>
    </div>
    
    <div class="product-buy">
        <div class="product-buy__cta">
            <p class="price">$' . $price . $oldprice_span . '</p>
            <div>
              <button type="button" class="primary">Buy now!</button>
              <button type="button" class="secondary">Add to cart</button>
            </div>
          </div>
          <div class="prodict-buy__deliver"></div>
          ';
          include('item_shop.php');
          echo'
    </div>
    ';

?>