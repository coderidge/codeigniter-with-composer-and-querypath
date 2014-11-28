    <?php
    require 'vendor/autoload.php';

    class Introduction extends CI_Controller { 

       public  function index() { 


    $artist_url = 'http://musicbrainz.org/ws/1/artist/?type=xml&name=elbow ';
    $album_url = 'http://musicbrainz.org/ws/1/release/?type=xml&artistid=';

    try {

      $artist =qp($artist_url, 'artist:first');

      $id = $artist->attr('id');

     $data['artist'] = qp($artist_url, 'artist:first');

     $data['albums'] = qp($album_url . urlencode($id))->writeXML();

    }

    catch (Exception $e) {
      print $e->getMessage();
    }

           $this->load->view('what_about',$data);

        }   


         public function basicexample() { 
            
        qp(QueryPath::HTML_STUB)->find('body')->text('Hello World')->writeHTML();
      $qp = htmlqp(QueryPath::HTML_STUB, 'body');
      $qp->append('<div></div><p id="cool">Hello</p><p id="notcool">Goodbye</p>')
      ->children('p')
      ->after('<p id="new">new paragraph</p>');
      echo ($qp->find('p')->children('p')->html()) ? 'print' : 'donnt';;
            
            
        }
        
        public function ataglance() { 
        
            
$demo = '<?xml version="1.0" ?>
<data>
<li>Foo</li>
<li>Foo</li>
<li>Foo</li>
<li>Foo</li>
<li>Foo</li>
</data>
';

        $qp = qp($demo, 'data');

        // Iterate over elements as DOMNodes:
        foreach ($qp->get() as $li_ele) {
          print $li_ele->tagName . PHP_EOL; // Prints 'li' five times.
        }

        // Iterate over elements as QueryPath objects
        foreach ($qp as $li_qp) {
          print $li_qp->tag() . PHP_EOL; // Prints 'li' five times
        }

        function callbackFunction($index, $element) {
          print $element->tagName . PHP_EOL;
        }

        // Iterate using a callback function
        $qp->each('callbackFunction');

        // Iterate using a Lambda-style function
        $qp->eachLambda('return $item->tagName . PHP_EOL;');

        // Loop through by index/count
        for ($i = 0; $i < $qp->size(); ++$i) {
          $domElement = $qp->get($i);
          print $domElement->tagName . PHP_EOL;
        }

        
                }

    }
