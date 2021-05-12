<?php
/*
 * Template Name: Categories
 */

get_header();

$categories = get_categories();

 foreach($categories as $category) { 
	 ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <div class="col-xs-6 col-md-3">
		<div class="card" style="width: 25rem; border: 1px solid black; padding: 20px; margin-top: 50px;">
			<div class="card-body">
				<h5 class="card-title"><?php echo $category->name; ?></h5>
				<p class="card-text"><?php echo $category->description;  ?></p>
				<a href="<?php echo get_category_link($category->term_id); ?>" class="card-link" style=" border: 1px solid black; padding: 5px; padding-left: 50px; padding-right: 50px;">Read More</a>	
			</div>
		</div>
      </div>
<?php } ?>
    </div>
</div>	
<?php
get_footer();
?>