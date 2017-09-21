<html>
  <head>
    <script type="text/javascript" src="renderjson.js"></script>
    <SCRIPT LANGUAGE=JavaScript>
    function get_query_argument(name, href) {
    
      href = (href) || window.location.href;
      name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
    
      var regexS = "[\\?&]"+name+"=([^&#]*)";
      var regex = new RegExp( regexS );
      var results = regex.exec(href);
    
      return (results == null ? "" : results[1]);
    };
    function reload_new_search() {
      var url = "index.php";
      location.href=url;
    };
    </SCRIPT>
  </head>
    
  <body>
    <?php
      // Get args passed.
      $node_input=$_GET['nodename'];
      $dir = getcwd();

      print "<h1>Attribute Display for ". $node_input . "  ";
      print "<INPUT TYPE=Button VALUE='New Search' Onclick='reload_new_search()'></h1>";

      exec("/usr/bin/knife node list -s https://cs1chl001.classifiedventures.com:443 -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb | grep -i -c " . $node_input, $countout, $retval );
      switch ($countout[0]) {
        case 0:
            echo "<p>ERROR: Node '". $node_input . "' could not be found.";
            break;
        case 1:
          exec("/usr/bin/knife node list -s https://cs1chl001.classifiedventures.com:443 -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb | grep -i " . $node_input, $node_name, $retval );

          exec("/usr/bin/knife node show " . $node_name[0] . " -l -F json -s https://cs1chl001.classifiedventures.com:443 -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb|./jq '{ name: .name, environment: .chef_environment, run_list: .run_list, attr: ( .default + .normal + .override + .force_override + .automatic)}'", $jsonout, $retval );
          $str_obj = implode("", $jsonout);

          echo '<p>Last Update: ';
          foreach($jsonout as $a) {
            if (strpos($a, 'ohai_time') ) {
               $d = explode(':', $a);
               echo date('r', str_replace(',','',$d[1]));
            }
          }
          echo '</p>';
          echo '<pre><div id="output"></div></pre>';
          echo '<script>document.getElementById("output").appendChild(renderjson.set_show_to_level(1).set_icons("+", "-")('. $str_obj . '));</script>';
          break;
        default:
          echo "<p>ERROR: Multiple possible nodes found for " . $node_input . ".  Please select below.</BR>";
          exec("/usr/bin/knife node list -s https://cs1chl001.classifiedventures.com:443 -u readonly -k " . $dir . "/.chef/readonly.pem -c " . $dir . "/.chef/knife.rb | grep -i  " . $node_input, $node_list, $retval );
          foreach ($node_list as $node) {
            echo "<a href='display_node.php?nodename=".$node."'>".$node."</a></BR>";
          }
          echo "</p>";
          break;
      };
    ?>
  </body>
</html>
