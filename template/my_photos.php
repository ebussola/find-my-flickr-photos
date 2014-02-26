<?php foreach ($this->photos as $photo) :?>
    <div style="float:left; width:240px; margin: 3px">
        <?php echo $photo->title?><br />
        <a target="_blank" onclick="click_photo(this)" href="https://www.google.com/searchbyimage?&image_url=<?php echo $photo->big?>">
            <img src="<?php echo $photo->small?>" />
        </a>
    </div>
<?php endforeach?>