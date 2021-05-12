<?php 
/*
 * Template Name: My Category1
*/
get_header();
            $categories = get_categories();
            // print_r(get_categories());
            foreach($categories as $category) {
              // echo $category->name;
               echo '<div class="card" style="margin-top:90px; ">
               <div class="card-body">
                 <h5 class="card-title" style="text-align:center; font-size:1.5rem;     background-color: #b9a8a836;" ><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></h5>
                 <p class="card-text"> ' . $category->description . 'In the card title and make up the bulk of the cards content.</p>
                 <span class="readmore" >
                  <a href="http://wordpress.local/category/'. $category->name . '/ style="color:blue" ">Read More</a>
               </span>
               </div>
               
                   </div>'
                   ;
            }
            get_footer();                   
            ?>
<style> 



.site-main{
    width: 1240px;
    display: grid;
    grid-template-columns: auto auto ;
    padding: 10px;
}
.card{
    margin: 0px 50px 0px 50px;
    height: 240px;
    border: 5px solid rgba(0, 0, 0, 0.8);
    padding: 20px;
   
    background-color: rgb(128, 122, 122);
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}
.card-body{
    overflow: auto;
    font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}
.card:hover{
    background-color: rgb(105, 100, 100);
}
</style>     