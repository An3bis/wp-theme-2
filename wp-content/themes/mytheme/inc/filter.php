<div class="card filter">
    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Filter:</li>
            <li class="list-group-item">

            <?php $taxe = new Taxes; ?>

            <form action="select1.php" method="post">
                <?php foreach($taxe->getAllTaxes() as $key): ?>

                    <select>
                        <option><?php echo $key; ?></option>

                        <?php for($i=0; $i<count( $terms = $taxe->getTerms($key) ); $i++): ?>

                            <option value="<?php echo $terms[$i]->name; ?>"><?php echo $terms[$i]->name; ?></option>
                            
                        <?php endfor; ?>

                    </select> 

                <?php endforeach; ?>
            </form>

            </li>
            <li><input type="button" value="Click Me"></li>
        </ul>
    </div>	
</div>