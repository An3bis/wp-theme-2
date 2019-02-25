<form action="" method="post">
    <div class="card filter">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Filter:</li>
                <li class="list-group-item">

                <?php $taxe = new Taxes; ?>

                    <?php foreach($taxe->getAllTaxes() as $key): ?>

                        <select>
                            <option><?php echo $key; ?></option>

                            <?php for($i=0; $i<count( $terms = $taxe->getTerms($key) ); $i++): ?>

                                <option value="<?php echo $terms[$i]->name; ?>"><?php echo $terms[$i]->name; ?></option>
                                
                            <?php endfor; ?>

                        </select> 

                    <?php endforeach; ?>
            
                </li>
                <li><input type="button" value="Click Me" id="filter-btn"></li>
            </ul>
        </div>	
    </div>
</form>

<script>   
$.ajax({
    type: "POST",
    url: window.wp_data.ajax_url, 
    data : {
        action : 'test', 
        manufacture_id : manufacture, 
        year_id : year,
        screen_id: screen,
        processor_id: processor,
        ram_id   : ram,
        cena_max : maxprice,
        cena_min : minprice
        
    },
    success: function (data) {
        alert(1);
    }   
});      
</script>