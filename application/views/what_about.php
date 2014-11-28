<?php


echo "<h3>Artist</h3>";

   
    echo '<p>The best match we found was for ' . $artist->children('name')->text() ;
  
    //echo '</p><p><a href="'.$album_url . urlencode($id).'">'.$album_url.'</a></p>';

   echo "<h3>Albums</h3>";

  foreach ($albums as $album) {
      echo '<h2>'. $album->find('title')->text() ;
      echo "</h2><br/><br/><h3>";
      echo $album->next('label')->text() . '</h3><br/><br/>' ;
    }
