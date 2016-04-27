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

    private $title;
    private $metaDescription;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param mixed $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return mixed
     */
    public function getHtmlContent()
    {
        return $this->htmlContent;
    }

    /**
     * @param mixed $htmlContent
     */
    public function setHtmlContent($htmlContent)
    {
        $this->htmlContent = $htmlContent;
    }
    private $htmlContent;
    
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
    
    

    public function getContent($id, $lang)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM page_has_language
                                    WHERE page_idpage = (:id) AND language_idlanguage = (:lang)');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':lang', $lang);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            var_dump($result);

            if ($stmt->rowCount() > 0) {
                
                $this->setTitle($result['pl_title']);
                $this->setHtmlContent($result['pl_htmltext']);
                
            }
        }
        catch (\Exception $e)
        {
            $e->getMessage();
        }
    }

    public function getMainMenu($lang)
    {
        try {
            $stmt = $this->db->prepare('SELECT page_idpage, pl_menu_link_title FROM page_has_language
                                    WHERE pl_menu_link_main_menu = 1 AND language_idlanguage = (:lang)');
            $stmt->bindParam(':lang', $lang);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            if ($stmt->rowCount() > 0) {

                $html = print('<ul class="menu">');
                foreach ($result as $index => $item) {
                    //var_dump($result);
                    $html .= print('<li><a href="addContent.php?id=' . $item['page_idpage'] . '">' . $item['pl_menu_link_title'] . '</a></li>');
                }
                $html .= print('</ul>');
            }
        }
        catch (\Exception $e)
        {
            $e->getMessage();
        }
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
