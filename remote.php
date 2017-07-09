<?php
class remote_plugin_xmlrpc extends DokuWiki_Remote_Plugin {
    public function _getMethods() {
        return array(
            'getPageXml' => array(
                'args' => array('string'),
                'return' => 'string',
                'doc' => 'Get page in XML version.',
                'name' => 'getPageXml'
            )
        );
    }

    public function getPageXml($id,$rev=''){
      $id = cleanID($id);
      if(auth_quickaclcheck($id) < AUTH_READ){
          throw new RemoteAccessDeniedException('You are not allowed to read this file', 111);
      }

      $mode = 'xml';
      // if to export headers should be imortant here's the code to make it (not tested)
      //$headers = p_get_metadata($id,"format $mode");
      $output = p_cached_output(wikiFN($id,$rev), $mode, $id);
      return $output;
  }
}
