<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 14.04.16
 * Time: 19:58
 */

namespace Models;


class Content
{


    /**
     * @var \PDO
     */
    private $db;
    
    function __construct($db_con)
    {
        $this->db = $db_con;
    }

    public function addContent()
    {
        try
        {
            $stmt1 = $this->db->prepare('INSERT INTO page (pagename) VALUES (:pagename)');
            $stmt2 = $this->db->prepare('INSERT INTO page_has_language 
                                        (language_idlanguage, pl_headertitle, pl_sitename, pl_slogan, pl_h1, pl_htmltext) VALUES
                                        (:lang, :pagetitle, :headertitle, :sitename, :slogan, :h1, :htmltext)');
            $stmt1->bindParam(':pagename', $pageName);
            $stmt2->bindParam(':lang', $language);
            $stmt2->bindParam(':pagetitle', $pageTitle);
            $stmt2->bindParam(':headertitle', $headerTitle);
            $stmt2->bindParam(':sitename', $siteName);
            $stmt2->bindParam(':slogan', $slogan);
            $stmt2->bindParam(':h1', $h1);
            $stmt2->bindParam(':htmltext', $htmlText);
            $stmt1->execute();
            $stmt2->execute();
            return true;

        }
        catch (\Exception $e)
        {
            $e->getMessage();
        }
    }

    public function getContent()
    {
        
    }
    
    
}