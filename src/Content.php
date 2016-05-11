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
    private $htmlContent;
    private $menuLinkTitle;
    private $image;

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    

    /**
     * @return mixed
     */
    public function getMenuLinkTitle()
    {
        return $this->menuLinkTitle;
    }

    /**
     * @param mixed $menuLinkTitle
     */
    public function setMenuLinkTitle($menuLinkTitle)
    {
        $this->menuLinkTitle = $menuLinkTitle;
    }


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
    
    function __construct($db_con)
    {
        $this->db = $db_con;
    }

    public function addContent($pageName, $language, $title, $metaDescription, $h1, $htmlText, $menuLinkTitle, $menuLinkTitleMainMenu, $menuLinkTitleFooterMenu, $image_path )
    {
        try
        {
            $stmt = $this->db->prepare('INSERT INTO page (pagename) VALUES(:pagename);
                                         SET @last_id := (SELECT LAST_INSERT_ID());
                                         INSERT INTO page_has_language (page_idpage, language_idlanguage, pl_title, pl_meta_description, pl_h1, pl_htmltext, pl_menu_link_title, pl_menu_link_main_menu, pl_menu_link_footer_menu, pl_image) 
                                         VALUES(@last_id, :lang, :title, :meta_description, :h1, :htmltext, :menu_link_title, :menu_link_title_main_menu, :menu_link_title_footer_menu, :image);
                                         ');
                                      
            $stmt->bindParam(':pagename', $pageName);
            $stmt->bindParam(':lang', $language);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':meta_description', $metaDescription);
            $stmt->bindParam(':h1', $h1);
            $stmt->bindParam(':htmltext', $htmlText);
            $stmt->bindParam(':menu_link_title', $menuLinkTitle);
            $stmt->bindParam(':menu_link_title_main_menu', $menuLinkTitleMainMenu);
            $stmt->bindParam(':menu_link_title_footer_menu', $menuLinkTitleFooterMenu);
            $stmt->bindParam(':image', $image_path);

            $stmt->execute();
            return true;

        }
        catch (\Exception $e)
        {
            $e->getMessage();
        }
    }

    public function translateContent($id, $pageName, $language, $title, $metaDescription, $h1, $htmlText, $menuLinkTitle, $menuLinkTitleMainMenu, $menuLinkTitleFooterMenu)
    {
        try
        {
            $stmt = $this->db->prepare('INSERT INTO page_has_language (page_idpage, language_idlanguage, pl_title, pl_meta_description, pl_h1, pl_htmltext, pl_menu_link_title, pl_menu_link_main_menu, pl_menu_link_footer_menu) 
                                        VALUES(:id, 2, :title, :meta_description, :h1, :htmltext, :menu_link_title, :menu_link_title_main_menu, :menu_link_title_footer_menu);
                                         ');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':pagename', $pageName);
            $stmt->bindParam(':lang', $language);
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
            //var_dump($result);

            if ($stmt->rowCount() > 0) {
                
                $this->setTitle($result['pl_title']);
                $this->setHtmlContent($result['pl_htmltext']);
                $this->setMenuLinkTitle($result['pl_menu_link_title']);
                $this->setMetaDescription($result['pl_meta_description']);
                if(!$result['pl_image'] == '') {
                    $system_image_url = $result['pl_image'];
                    $url_parts = explode('/', $system_image_url);
                    $web_image_url = '/' . $url_parts[4] . '/' . $url_parts[5] . '/' . $url_parts[6] . '/' . $url_parts[7];
                    $this->setImage($web_image_url);
                }
                return TRUE;
                
            }
            
        }
        catch (\Exception $e)
        {
            $e->getMessage();
        }
    }
    
    public function contentList($lang)
    {
        try {
            $stmt = $this->db->prepare('SELECT * FROM page_has_language WHERE language_idlanguage = (:lang)');
            $stmt->bindParam(':lang', $lang);
            $stmt->execute();
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            print('<table><thead><tr><th>Titel</th><th>Meta Desription</th><th>Menü</th><th></th></tr></thead>');
            foreach ($result as $index => $item) {
                printf('<tr><td>%s</td><td>%s</td><td>%s</td><td><a href="addContent">bearbeiten</a></td></tr>', $item['pl_title'], $item['pl_meta_description'], $item['pl_menu_link_title']);
            }
            print('</table>');
        }
        catch(\Exception $e)
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

                $html = print('<div class="top-bar-left"><ul class="menu">');
                foreach ($result as $index => $item) {
                    //var_dump($result);
                    $html .= print('<li><a href="index.php?id=' . $item['page_idpage'] . '">' . $item['pl_menu_link_title'] . '</a></li>');
                }
                $html .= print('</ul></div>');
                return TRUE;
            }
        }
        catch (\Exception $e)
        {
            $e->getMessage();
        }
    }

    public static function getUserMenu()
    {
        print '<div class="top-bar-right"><ul class="dropdown menu" data-dropdown-menu>
                    <li>
                        <a>' . $_SESSION['user_name'] . '\'s Menü</a>
                        <ul class="menu">
                            <li><a href="?content=add">Inhalt hinzufügen</a></li>
                            <li><a href="?content=add">Inhalt bearbeiten</a></li>
                            <li><a href="logout.php?logout=true">abmelden</a></li>
                        </ul>
                    </li>
               </ul></div>';
    }

    // stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string

/*    public function slugify($text)
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
    }*/
    
    
    
    
}
