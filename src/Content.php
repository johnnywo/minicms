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

    public function addContent($pageName, $language, $url, $title, $metaDescription, $h1, $htmlText, $menuLinkTitle, $menuLinkTitleMainMenu, $menuLinkTitleFooterMenu )
    {
        try
        {
            $stmt = $this->db->prepare('INSERT INTO page (pagename) VALUES(:pagename);
                                         SET @last_id := (SELECT LAST_INSERT_ID());
                                         INSERT INTO page_has_language (page_idpage, language_idlanguage, pl_url, pl_title, pl_meta_description, pl_h1, pl_htmltext, pl_menu_link_title, pl_menu_link_main_menu, pl_menu_link_footer_menu) 
                                         VALUES(@last_id, :lang, :url, :title, :meta_description, :h1, :htmltext, :menu_link_title, :menu_link_title_main_menu, :menu_link_title_footer_menu);
                                         ');
                                      
            $stmt->bindParam(':pagename', $pageName);
            $stmt->bindParam(':lang', $language);
            $stmt->bindParam(':url', $url);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':meta_description', $metaDescription);
            $stmt->bindParam(':h1', $h1);
            $stmt->bindParam(':htmltext', $htmlText);
            $stmt->bindParam(':menu_link_title', $menuLinkTitle);
            $stmt->bindParam(':menu_link_title_main_menu', $menuLinkTitleMainMenu);
            $stmt->bindParam(':menu_link_title_footer_menu', $menuLinkTitleFooterMenu);

            $stmt->execute();
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

    // stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string

    public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'ISO-8859-1//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
    
    
}
