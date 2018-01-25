<?php require_once __DIR__ . '/php-graph-sdk-5.0.0/src/Facebook/autoload.php';?>
<html> 
    <head> 
  <style> 
      body{ 
        text-align: center; 
      }  
      #ubanner{ 
          margin: auto; 
          background-color:darkgray; 
          width:70%; 
          font-weight: 100; 
          text-align: left; 
          margin: auto; 
      } 
      #ubanner h1{ 
          font-family: sans-serif; 
          font-size: 20px; 
          font-style: italic; 
          font-weight: 100; 
          align-content: center; 
          text-align: center; 
          background-color:darkgray; 
          width: 70%; 
          margin: auto;       
      } 
      .tab{
          width:80%;
          margin:auto;
          border:2px solid black;
          border-collapse: collapse;
      }
      
      .tab th{
          text-align: left;
          border: 2px solid black;
          border-collapse: collapse;
      }
      #Type{
          width:10%;
          margin-left:3%;
      }
      .tab td{
          text-align: left;
          border: 2px solid black;
          border-collapse:collapse;
      }
      
      #posts{
          background-color: darkgray;
          width:60%;
          margin: auto;
        
      }
      .pos{
          display: none;
          background-color: snow;
         
          width:60%;
          margin: auto;
          
      }
      .alb{
          display: none;
          background-color: snow;
          
          width:60%;
          margin: auto;
      }
          #format{
             margin: auto;
             text-align: left;
            width:60%;
      }
      
      #albums{
          background-color: darkgray;
          width:60%;
          margin: auto;
          
            }
      #whitespace{
          background-color: white;
      }
      .cls_0,.cls_1,.cls_2,.cls_3,.cls_4{ display:none;}
      
    </style> 
       
     
    </head> 
     
    <body> 
        
    
    <script type="text/javascript"> 
        function f(){ 
            
            var val=document.getElementById('Type'); 
            var val_text=val.options[val.selectedIndex]; 
            if (val_text.value=='place') 
                { 
                  document.getElementById('loc').innerHTML="&nbsp;&nbsp;Location<input type=text id=\"location\" name=\"location\" value=\"<?php echo isset($_GET['location']) ? $_GET['location'] : '' ?>\">&nbsp;&nbsp;Distance(metres):<input type=text id=\"distance\" name=\"distance\" value=\"<?php echo isset($_GET['distance']) ? $_GET['distance'] : '' ?>\"  >"; 
                } 
            else{ 
                document.getElementById('loc').innerHTML="";
                 
            } 
             
        } 
             
        function alb_post(){
            alert("Here");
        }
        
        function hiding1(num){
            name='';
            if (num==1)
                {name="alb";
                 elem=document.getElementsByClassName("pos");
                for(i=0;i<elem.length;i++)
                    {elem[i].style.display="none";}
                
                }
            if(num==2){
                name="pos";
                elem=document.getElementsByClassName("alb");
                for(i=0;i<elem.length;i++)
                    {elem[i].style.display="none";}
            }
            elem=document.getElementsByClassName(name);
            for(i=0;i<elem.length;i++)
                {
               if(elem[i].style.display=="inline")
                   elem[i].style.display="none";
                else
                    elem[i].style.display="inline";
                }
        }
               
        
         function fn_clear(){ 
           
                document.getElementById('Keyword').value=""; 
                document.getElementById('Type').selectedIndex=0; 
                document.getElementById('loc').innerHTML="";  
                document.getElementById('distance').value="";
                document.getElementById('location').value="";
                document.getElementById('lower_table').innerHTML="";
                document.getElementById('albums').style.display="none";
                document.getElementById('posts').style.display="none";
                
            } 
        
       
          function hiding3(i){
              name="cls_"+i;
            elem=document.getElementsByClassName(name);
            for($i=0;$i<elem.length;$i++)
                {
               if(elem[$i].style.display=="inline")
                   elem[$i].style.display="none";
                else
                    elem[$i].style.display="inline";
                }
        } 
            
        </script> 
        
       
        <!-- HTML UI-->

       <div id="ubanner"> 
            <h1>Facebook Search</h1> 
            <hr> 
         
        <form  method="get"  id="form"> 
             &nbsp;&nbsp;Keyword<input type=text id="Keyword" name="keyword" required="required" oninvalid="this.setCustomValidity('This cant be left empty')" oninput="setCustomValidity('')"  value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>"><br/> 
             &nbsp;&nbsp;Type:<select id="Type" name="type" onchange="f()" > 
                <option value="user"<?php echo isset($_GET[ "type"])&&($_GET[ "type"]=="user" )? "selected" : "user"; ?>>Users</option> 
    
                <option value="page" <?php echo isset($_GET[ "type"])&&($_GET[ "type"]=="page" )? "selected" : "page"; ?>>Pages</option> 
                    
                <option value="event" <?php echo isset($_GET[ "type"])&&($_GET[ "type"]=="event" )? "selected" : "event"; ?>>Events</option> 
                    
                <option value="group" <?php echo isset($_GET[ "type"])&&($_GET[ "type"]=="group" )? "selected" : "group"; ?>>Groups</option> 
                    
                <option value="place" <?php echo isset($_GET[ "type"])&&($_GET[ "type"]=="place" )? "selected" : "place"; ?> >Places</option >           
            </select> 
            <div id="loc"></div> 
            <br/>  
            <br/> 
            <br/> 
               &nbsp;&nbsp;<input type="submit" name="search" value="Search" onsubmit="f()"  style="width:10%;margin-left:7%"> 
              <input type="submit" value="Clear" name="Clear" onsubmit="fn_clear()" style="width:10%;"> 
            </form> 
           
            </div>
        
        
      <?php       
        function details($id,$fb){
            
        $details_url="https://graph.facebook.com/v2.8/".$id."?fields=id,name,picture.width(700).height(700),albums.limit(5){name,photos.limit(2){name,picture}},posts.limit(5)&access_token=EAACYYjRsqkIBAOQSpa7WspAnAer8CNbZBmD37gjI4BwDF8df5O3ExHLpdez46wTLKvDeprhKgFZB8u1rBmuwmZC9ycAv1KgQa6gw4dNZCHGC4qSCTlljBNHUV7K6SfI7algDZCNFjPoTaWnEWfsl02mkEMBeZCIZCIZD";
             $fb = new Facebook\Facebook(['app_id' => '167547553753666','app_secret' => '5e54f1cbabf210d03950e8abe1ff09c7','default_graph_version' => 'v2.8']); 
    
        $fb->setDefaultAccessToken('EAACYYjRsqkIBAOQSpa7WspAnAer8CNbZBmD37gjI4BwDF8df5O3ExHLpdez46wTLKvDeprhKgFZB8u1rBmuwmZC9ycAv1KgQa6gw4dNZCHGC4qSCTlljBNHUV7K6SfI7algDZCNFjPoTaWnEWfsl02mkEMBeZCIZCIZD');    
    
        try {
                $response = $fb->get('/me');
              $userNode = $response->getGraphUser();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
             $request = $fb->request('GET','/'.$id);
             $request->setParams([
                            'fields' => 'id,name,picture.width(700).height(700)'
                        ]);
            #echo $request;
            $response = $fb->getClient()->sendRequest($request);
            $json = $response->getBody();
            $json_response= json_decode($json, true);
            //echo $json_response1;
            //echo $details_url;
            $details_url = str_replace("", "%20", $details_url);
            $json = file_get_contents($details_url);
            $json_response1 = json_decode($json, true); 
            $txt="<div id='albums'>";
            $len=0;
            try{
                if (isset($json_response1['albums']['data'])){
                $len=count($json_response1['albums']['data']);}
            }
            catch(Exception $e){
                $len=0;
                 }
            if ($len==0){
                 $txt.="No Albums found<br/></div>";
                
            }
            else{$txt.="<a href=\"javascript:hiding1(1)\">Albums</a><br/></div>";

            //$class="cls_1";
            for ($i = 0; $i < count($json_response1['albums']['data']); $i++){
                //$abc=$class;
                $class="cls_".$i;
                $txt.="<tr><div class='alb'> <a href=\"javascript:hiding3($i)\" class='l'>".$json_response1['albums']['data'][$i]['name']."</a><br/><div class='pics'>";
                
                if(isset($json_response1['albums']['data'][$i]['photos']['data'])){
                $pic=$json_response1['albums']['data'][$i]['photos']['data'];}
                else{$pic=0;}
                if(count($pic)==0){$txt.="No picture found!";}
                else{
                    $class="cls_".$i;
                    for($j=0;$j<count($pic); $j++)
                    {   $id=$pic[$j]['id'];
                        $href_src="https://graph.facebook.com/v2.8/".$id."/picture?access_token=EAACYYjRsqkIBAOQSpa7WspAnAer8CNbZBmD37gjI4BwDF8df5O3ExHLpdez46wTLKvDeprhKgFZB8u1rBmuwmZC9ycAv1KgQa6gw4dNZCHGC4qSCTlljBNHUV7K6SfI7algDZCNFjPoTaWnEWfsl02mkEMBeZCIZCIZD";
                        $txt.="<div class=".$class."><a target='_blank' href='";
                        $txt.=$href_src;
                        $txt.="'><img src='";
                        $txt.=$pic[$j]['picture'];
                        $txt.="'style='height:50px;width:60px;align:left;'></img></a></div>&nbsp;&nbsp;&nbsp;&nbsp;";
                        
                    }
                    
                }
                
                $txt.="<br/></div></div>";
            }
                
            
                
                }
            $txt.="<div id='whitespace'><br/></div>";
                
            //POSTS
            $txt.="<div id='posts'>";
            $len1=0;
            try{
                if (isset($json_response1['posts']['data'])){
                $len1=count($json_response1['posts']['data']);}
            }
            catch(Exception $e){
                $len1=0;
            }
            if ($len1==0){
                $txt.="No Posts found<br/></div>";
                
            }
            else{ 
                $txt.="<a href=\"javascript:hiding1(2)\">Posts</a><br/></div><div id=\"format\">";
            
            
            for ($i = 0; $i < count($json_response1['posts']['data']); $i++){
               
                $txt.="<div class='pos'>";
                if(isset($json_response1['posts']['data'][$i]['message'])){
                $txt.=$json_response1['posts']['data'][$i]['message'];}
                $txt.="<br/><hr></div>";}
            }
            
            $txt.="</div></div>";
            
            
            
            return $txt;
        }
      
        $fb = new Facebook\Facebook(['app_id' => '167547553753666','app_secret' => '5e54f1cbabf210d03950e8abe1ff09c7','default_graph_version' => 'v2.8']); 
    
        $fb->setDefaultAccessToken('EAACYYjRsqkIBAOQSpa7WspAnAer8CNbZBmD37gjI4BwDF8df5O3ExHLpdez46wTLKvDeprhKgFZB8u1rBmuwmZC9ycAv1KgQa6gw4dNZCHGC4qSCTlljBNHUV7K6SfI7algDZCNFjPoTaWnEWfsl02mkEMBeZCIZCIZD');    
    
        try {
                $response = $fb->get('/me');
              $userNode = $response->getGraphUser();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }
     //Remove   
    //echo "Hello";
    
    $url  = "";
    //Remove
    //echo $key;
    //echo $type;
   
    if (isset($_GET['Clear'])){$_GET['distance']="";
                               $_GET['location']="";
        echo '<script type="text/javascript">fn_clear();</script>';}   

    if (isset($_GET['details']))
        {
        echo '<script type="text/javascript">f();</script>';
        $id=$_GET['details'];
        $txt=details($id,$fb);
        echo $txt;
        }
        
    if (isset($_GET['search']))
    {
     echo '<script type="text/javascript">f();</script>';
     $key  = $_GET["keyword"];
     $type = $_GET["type"];
     $request = $fb->request('GET','/search');
        //USERS,PAGES,GROUPS
    if(strcmp($_GET["type"],"user")==0||strcmp($_GET["type"],"page")==0||strcmp($_GET["type"], "group")==0) 
    {
        
        $request->setParams([
                            'q' => $key,
                            'type' => $type,
                            'fields' => 'id,name,picture.width(700).height(700)'
                        ]);
        $response = $fb->getClient()->sendRequest($request);
        $json = $response->getBody();
        $json_response= json_decode($json, true);
        $html="";
        if (sizeof($json_response['data'])== 0) {
            $html= '<html><body><h3 id="head">No Records have been found</h3></body></html>';
            echo $html;
        }
        
        else {
            $html.='<div id="lower_table"><table align="center" class="tab"><tr><th>Profile Photo</th><th >Name</th><th>Details</th></tr>';
            
            $details = "";
            for ($i = 0; $i < count($json_response['data']); $i++) {
                $pro_pic = $json_response['data'][$i]['picture']['data']['url'];
                $name    = $json_response['data'][$i]['name'];
                $details = $json_response['data'][$i]['id'];
               $html.= '<tr><td><a target="_blank" href="'.$pro_pic.'"><img src='.$pro_pic.' style="height:30px;width:40px;align:left"></img></a></td><td>' . $name . '</td><td><a href="http://cs-server.usc.edu:16185/backup.php?details='.$details.'&keyword='.$key.'&type='.$type.'">Details</a></td></tr>';
                
        
                
            }
            //$details="124984464200434";
            
            $html.='</div></table>';
            echo $html;
             
        }
    }
        
        
        
        //PLACES
        
        
        elseif(strcmp($_GET["type"],"place")==0){
            $address=$_GET['location'];
            if ($address==""){
                $address="null";
            }
            $google_url="https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyC1nOjUXW1kH3MjWRI1jM4VU7yGXMonpWg";
            $google_url = str_replace(" ", "%20", $google_url);
            $json = file_get_contents($google_url);
            $json_response1 = json_decode($json, true);
            if (sizeof($json_response1['results'])== 0){
                echo '<html><body><h3 id="head">No Records have been found</h3></body></html>';
             
            }
            else{
            $lat=$json_response1["results"][0]['geometry']['location']['lat'];
            $lng=$json_response1["results"][0]['geometry']['location']['lng'];
            //echo $lat;
            //echo $lng;
            $distance=$_GET['distance'];
            
                
            $request->setParams([
                            'q' => $key,
                            'type' => $type,
                            'fields' => 'id,name,place,picture.width(700).height(700)',
                            'center'=>$lat.','.$lng,
                            'distance'=>$distance
                        ]);
            $response = $fb->getClient()->sendRequest($request);
            $json = $response->getBody();
            $json_response= json_decode($json, true);
             if (sizeof($json_response['data'])== 0) {
            echo '<html><body><h3 id="head">No Records have been found</h3></body></html>';
             }
        
            else {
            echo '<div id="lower_table"><table align="center" class="tab"><tr><th>Profile Photo</th><th >Name</th><th>Details</th></tr>';
            $details = "";
            for ($i = 0; $i < count($json_response['data']); $i++) {
                $pro_pic = $json_response['data'][$i]['picture']['data']['url'];
                $name    = $json_response['data'][$i]['name'];
                $details = $json_response['data'][$i]['id'];
                echo '<tr><td><a target="_blank" href="'.$pro_pic.'"><img src='.$pro_pic.' style="height:30px;width:40px;align:left"></img></a></td><td>' . $name . '</td><td><a href="http://cs-server.usc.edu:16185/backup.php?details='.$details.'&keyword='.$key.'&type='.$type.'&location='.$address.'&distance='.$distance.'">Details</a></td></tr>';
                
            }
            
            echo '</div></table>';
        }
                
            
        }}
       
        
        
        //EVENTS
        
        else{
        
            
            $request->setParams([
                            'q' => $key,
                            'type' => $type,
                            'fields' => 'id,name,place,picture.width(700).height(700)'
                        ]);
            $response = $fb->getClient()->sendRequest($request);
            $json = $response->getBody();
            $json_response= json_decode($json, true);
            
        if (sizeof($json_response['data'])== 0) {
            echo '<html><body><h3 id="head">No Records have been found</h3></body></html>';
        }
        
        else {
            echo '<div id="lower_table"><table align="center" class="tab"><tr><th>Profile Photo</th><th >Name</th><th>Place</th></tr>';
            $details = "";
            for ($i = 0; $i < count($json_response['data']); $i++) {
                $pro_pic = $json_response['data'][$i]['picture']['data']['url'];
                $name    = $json_response['data'][$i]['name'];
                if (isset($json_response['data'][$i]['place']['name'])){
                $placename= $json_response['data'][$i]['place']['name'];}
                else{$placename=" ";}
                echo '<tr><td><a target="_blank" href="'.$pro_pic.'"><img src='.$pro_pic.' style="height:30px;width:40px;align:left"></img></a></td><td>' . $name . '</td><td>'.$placename.'</td></tr>';
                
            }
            
            echo '</div></table>';
        }
        }
        
    }
        
        
        


?> 
      
        
    <noscript></body></html> 