<div class="container">
    <!-- Example row of columns -->
    <div class="row">

        <?php 
        $products = new Products;
        $loop = $products->getProducts();
        
        $taxe = new Taxes; 

        if($loop->have_posts()):
            while($loop->have_posts()): 
                $loop->the_post(); ?>

                <div class="col-md-4">
                    <div class="card">

                        <?php if ( has_post_thumbnail() ): ?>
                            <img src="<?php echo the_post_thumbnail_url(); ?>" class="card-img-top" alt="Image cant load"> 
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?php  the_title(); ?></h5>
                            <p class="card-text"><?php the_content(); ?></p>
                        </div>
                        <ul class="list-group list-group-flush">

                            <?php foreach($taxe->getAllTaxes() as $key):
                                $card = $taxe->getTaxe( get_the_ID(), $taxe->getAllTaxes( )[$key] ); ?>

                                <li class="list-group-item">
                                    <span class="list-group-item-name"><?php echo $card[0]->taxonomy; ?></span>
                                    <span class="list-group-item-value"><?php echo $card[0]->name; ?></span>
                                </li>
                            <?php endforeach; ?>	

                        </ul>
                        <div class="card-body">
                            <a href="<?php echo the_permalink(); ?>" class="btn btn-primary card-btn">View</a>
                        </div>
                    </div>											
                </div>

            <?php endwhile;
        endif; ?>				    	

    </div>
</div>  