<?php global $carbon_data; 
$recycle = get_post_meta($carbon_data['ID'], 'recycle_data', true);
?>

<div class="form-group">

    <div class="input-group">
        <span class="input-group-addon lamb"> Do you recycle? </span>
        <select name="recycling" onchange="carbon_recycle()" id="recycling">
            <option value="a" <?php echo (!empty($carbon_data) && $recycle['recycling'] == 'a')? 'selected':''?>>Not much</options>
            <option value="b" <?php echo (!empty($carbon_data) && $recycle['recycling'] == 'b')? 'selected':''?>>Some of our waste</options>
            <option value="c" <?php echo (!empty($carbon_data) && $recycle['recycling'] == 'c')? 'selected':''?>>All materials locally recyclable</options>
        </select>
    </div>

    <div class="input-group">
        <span class="input-group-addon lamb"> Do You Compost? </span>
        <select name="compost" onchange="carbon_recycle()" id="compost">
            <option value="a" <?php echo (!empty($carbon_data) && $recycle['compost'] == 'a')? 'selected':''?>>Rarely</options>
            <option value="b" <?php echo (!empty($carbon_data) && $recycle['compost'] == 'b')? 'selected':''?>>Sometimes</options>
            <option value="c" <?php echo (!empty($carbon_data) && $recycle['compost'] == 'c')? 'selected':''?>>Whenever Possible</options>
        </select>
    </div>

    <div class="input-group">               
        <input type="hidden" name="co2_recycle" id="co2_recycle" value="<?php echo !empty($carbon_data)? $recycle['recycle_data']:'';?>">
    </div>

</div>