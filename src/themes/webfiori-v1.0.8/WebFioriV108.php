<?php
namespace webfiori\theme;

use webfiori\framework\Webfiori;
use webfiori\apiParser\APITheme;
use webfiori\apiParser\AttributeDef;
use webfiori\apiParser\NameSpaceAPI;
use webfiori\apiParser\FunctionDef;
use webfiori\ui\HTMLNode;
use webfiori\ui\HeadNode;
use webfiori\ui\Anchor;
use webfiori\ui\ListItem;
use webfiori\ui\Paragraph;
use webfiori\ui\UnorderedList;
use webfiori\framework\Page;
use webfiori\ui\JsCode;
/**
 * WebFiori Theme Which is bundled with v1.0.8 of the framework.
 *
 * @author Ibrahim
 */
class WebFioriV108 extends APITheme{
    public function __construct() {
        parent::__construct();
        $this->setVersion('1.0');
        $this->setAuthor('Ibrahim');
        $this->setName('WebFiori V108');
        $this->setLicenseName('MIT License');
        $this->setLicenseUrl('https://opensource.org/licenses/MIT');
        $this->setAfterLoaded(function(){
            Page::document()->getChildByID('page-body')->setClassName('row  ml-0 mr-0');
            Page::document()->getChildByID('page-body')->setStyle([
                'margin-top'=>'50px'
            ]);
            Page::document()->getBody()->setStyle([
                'max-height'=>'10px',
                'height'=>'10px'
            ]);
            Page::document()->getChildByID('main-content-area')->setClassName('col-9 p-5');
        });
    }
    
    public function createHTMLNode($options = array()){
        $nodeType = isset($options['type']) ? $options['type'] : '';
        $elementId = isset($options['element-id']) ? $options['element-id'] : null;
        if($nodeType == 'section'){
            $sec = new HTMLNode('section');
            $hLvl = isset($options['h-level']) ? $options['h-level'] : 3;
            $hLevelX = $hLvl > 0 && $hLvl < 7 ? $hLvl : 1;
            $h = new HTMLNode('h'.$hLevelX);
            $title = isset($options['title']) ? $options['title'] : 'Sec_Title';
            $h->addTextNode($title);
            $sec->addChild($h);
            if($elementId !== null){
                $h->setID($elementId);
            }
            return $sec;
        }
        else if($nodeType == 'col'){
            $node = new HTMLNode();
            $colSize = isset($options['size']) ? $options['size'] : null;
            if($colSize >= 1 && $colSize <= 12){
                $node->setClassName('col-'.$colSize);
            }
            else{
                $node->setClassName('col');
            }
            return $node;
        }
        else if($nodeType == 'vertical-nav-bar'){
            $mainNav = new HTMLNode('nav');
            $mainNav->setClassName('navbar navbar-expand-lg navbar-light p-0');
            $mainNav->setStyle([
                'width' => '300px'
            ]);
            $navbarId = isset($options['id']) ? $options['id'] : 'nav'.substr(hash('sha256',date('Y-m-d H:i:s')), 0,10);
            $button = new HTMLNode('button');
            $button->setClassName('navbar-toggler');
            $button->addTextNode('<span class="navbar-toggler-icon"></span>', false);
            $button->setAttributes([
                'data-toggle' => 'collapse',
                'data-target' => '#'.$navbarId,
                'type' => 'button',
                'aria-controls' => ''.$navbarId,
                'aria-expanded' => 'false'
            ]);
            $mainNav->addChild($button);

            $navItemsContainer = new HTMLNode();
            $navItemsContainer->setID($navbarId);
            $navItemsContainer->setClassName('collapse navbar-collapse');
            $mainNav->addChild($navItemsContainer);

            $mainLinksUl = new UnorderedList();
            $mainLinksUl->setClassName('navbar-nav flex-column');
            $listItems = isset($options['nav-links']) ? $options['nav-links'] : [];
            $index = 0;
            foreach ($listItems as $listItemArr){
                $linkLabel = isset($listItemArr['label']) ? $listItemArr['label'] : 'Item_Lbl';
                $itemLink = isset($listItemArr['link']) ? $listItemArr['link'] : '#';
                $isActive = isset($listItemArr['is-active']) && $listItemArr['is-active'] === true ? true : false;
                $mainLinksUl->addListItem('<a style="font-size:9pt;font-weight:bold;" href="'.$itemLink.'" class="nav-link p-0">'.$linkLabel.'</a>', false);
                if($isActive === true){
                    $mainLinksUl->getChild($index)->setClassName('nav-item active');
                }
                else{
                    $mainLinksUl->getChild($index)->setClassName('nav-item');
                }
                $index++;
            }
            $subLists = isset($options['sub-lists']) ? $options['sub-lists'] : [];
            foreach ($subLists as $subList){
                $listTxt = isset($subList['label']) ? $subList['label'] : 'Sub_list';
                $link = isset($subList['link']) ? $subList['link'] : null;
                $isActive = isset($subList['is-active']) && $subList['is-active'] === true ? true : false;
                $subListItems = isset($subList['list-items']) ? $subList['list-items']:[];
                $li = new ListItem();
                $li->setClassName('nav-item');
                $liDiv = new HTMLNode();
                $li->addChild($liDiv);
                $liDiv->setClassName('btn-group dropright');
                $textButton = new HTMLNode('button');
                $textButton->setClassName('btn btn-secondary p-0');
                $textButton->setAttribute('type', 'button');
                $textButton->setStyle([
                    'background'=>'transparent',
                    'border'=>'0px'
                ]);
                $liDiv->addChild($textButton);
                if($link !== null){
                    $textButton->addTextNode('<a style="font-size:9pt;font-weight:bold;" href="'.$link.'">'.$listTxt.'</a>', false);
                }
                else{
                    $textButton->addTextNode($listTxt);
                }
                $expandButton = new HTMLNode('button');
                $expandButton->setClassName('btn btn-secondary dropdown-toggle dropdown-toggle-split');
                $expandButton->setStyle([
                    'background'=>'transparent',
                    'border'=>'0px'
                ]);
                $expandButton->setAttributes([
                    'type'=>'button',
                    'data-toggle'=>"dropdown",
                    'aria-haspopup'=>"true",
                    'aria-expanded'=>"false"
                ]);
                $liDiv->addChild($expandButton);
                $subItemsContainer = new HTMLNode();
                $liDiv->addChild($subItemsContainer);
                $subItemsContainer->setAttributes([
                    'class'=>'dropdown-menu',
                    'x-placement'=>'right-start',
                    'style'=>'position: absolute; transform: translate3d(159px, 0px, 0px); top: 0px; left: 0px; will-change: transform;',
                ]);
                $index = 0; 
                foreach ($subListItems as $listItem){
                    $linkLabel = isset($listItem['label']) ? $listItem['label'] : 'Item_Lbl';
                    $itemLink = isset($listItem['link']) ? $listItem['link'] : '#';
                    $isActive = isset($listItem['is-active']) && $listItem['is-active'] === true ? true : false;
                    $linkNode = new Anchor($itemLink, $linkLabel);
                    $linkNode->setClassName('dropdown-item');
                    $subItemsContainer->addChild($linkNode);
                    if($isActive === true){
                        $subItemsContainer->getChild($index)->setClassName('active');
                    }
                    $index++;
                }
                $mainLinksUl->addChild($li);
            }
            $navItemsContainer->addChild($mainLinksUl);
            return $mainNav;
        }
        else if($nodeType == 'container'){
            $node = new HTMLNode();
            $node->setClassName('container');
            return $node;
        }
        else if($nodeType == 'row'){
            $node = new HTMLNode();
            $node->setClassName('row');
            return $node;
        }
        else if($nodeType == 'page-title'){
            $titleRow = $this->createHTMLNode(['type'=>'row']);
            $h1 = new HTMLNode('h2');
            $title = isset($options['title']) ? $options['title'] : Page::title();
            $h1->addTextNode($title,false);
            $h1->setClassName('page-title pb-2 mt-4 mb-2 border-bottom');
            $titleRow->addChild($h1);
            return $titleRow;
        }
        else if($nodeType == 'row'){
            $node = new HTMLNode();
            $node->setClassName('row');
            return $node;
        }
        $node = new HTMLNode();
        return $node;
    }

    public function getAsideNode(){
        $aside = new HTMLNode();
        $aside->setClassName('col-3');
        return $aside;
    }

    public function getFooterNode(){
        $footer = new HTMLNode('footer');
        $footer->setClassName('bd-footer text-muted');
        $footer->setClassName('container-fluid p-md-4');
        $footerLinksUl = new UnorderedList();
        $footerLinksUl->setClassName('nav justify-content-center');
        $footerLinksUl->addListItems([
            '<a href="https://github.com/usernane/webfiori">GitHub</a>',
            '<a href="https://twitter.com/webfiori_" >Twitter</a>',
            '<a href="https://t.me/webfiori" >Telegram</a>'
        ], false);
        $footerLinksUl->getChild(0)->setClassName('nav-item');
        $footerLinksUl->getChild(1)->setClassName('nav-item ml-3');
        $footerLinksUl->getChild(2)->setClassName('nav-item ml-3');
        $footer->addChild($footerLinksUl);
        $powerdByNode = new HTMLNode('p');
        $powerdByNode->addTextNode('Powered by: <a href="https://programmingacademia.com/webfiori">WebFiori Framework</a> v'.WebFiori::getConfig()->getVersion().'. '
                . 'Code licensed under the <a href="https://opensource.org/licenses/MIT">MIT License</a>.', false);
        $footer->addChild($powerdByNode);
        $img = new HTMLNode('img');
        $img->setAttribute('src', 'assets/images/favicon.png');
        $img->setAttribute('alt', 'logo');
        $img->setStyle([
            'height'=>'25px'
        ]);
        $footer->addChild($img);
        $copywriteNotice = new HTMLNode('p');
        $copywriteNotice->addTextNode('All Rights Reserved © '.date('Y'));
        $footer->addChild($copywriteNotice);
        return $footer;
    }
    public function getHeadNode(){
        $head = new HeadNode();
        $head->addLink('icon', 'assets/images/favicon.png',[
            'type'=>"image/png"
        ]);
        $head->addCSS(Page::cssDir().'/theme.css');
        $head->addCSS('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',[],false);
        $head->addJs('https://code.jquery.com/jquery-3.4.1.slim.min.js',[],false);
        $head->addJs('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js',[], false);
        $head->addJs('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js',[],false);
        $head->addJs("https://www.googletagmanager.com/gtag/js?id=UA-91825602-2", ['async'=>''], false);
        $jsCode = new JsCode();
        $jsCode->addCode("window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-91825602-2');");
        $head->addChild($jsCode);
        return $head;
    }

    public function getHeadrNode() {
        $header = new HTMLNode('header');
        $header->setClassName('container-fluid');
        $mainNav = new HTMLNode('nav');
        $header->addChild($mainNav);
        $mainNav->setClassName('navbar navbar-expand-lg navbar-light fixed-top');
        $mainNav->setStyle([
            'background-color'=>'#c1ec9b',
            'padding'=>'0'
        ]);
        $logo = new HTMLNode('img');
        $logo->setID('main-logo');
        $logo->setAttribute('src', 'assets/images/favicon.png');
        $logo->setAttribute('alt', 'logo');
        $logoLink = new Anchor(WebFiori::getSiteConfig()->getHomePage(), $logo->toHTML());
        $logoLink->setClassName('navbar-brand ml-3');
        $mainNav->addChild($logoLink);
        
        $button = new HTMLNode('button');
        $button->setClassName('navbar-toggler');
        $button->addTextNode('<span class="navbar-toggler-icon"></span>', false);
        $button->setAttribute('data-toggle', 'collapse');
        $button->setAttribute('data-target', '#navItemsContainer');
        $button->setAttribute('type', 'button');
        $button->setAttribute('aria-controls', 'navItemsContainer');
        $button->setAttribute('aria-expanded', 'false');
        $mainNav->addChild($button);
        
        $navItemsContainer = new HTMLNode();
        $navItemsContainer->setID('navItemsContainer');
        $navItemsContainer->setClassName('collapse navbar-collapse');
        $mainNav->addChild($navItemsContainer);
        
        $mainLinksUl = new UnorderedList();
        $mainLinksUl->setClassName('navbar-nav justify-content-center');
        $mainLinksUl->addListItems([
            '<a href="download" class="nav-link">Download</a>',
            '<a href="docs/webfiori" class="nav-link">API Docs</a>',
            '<a href="learn" class="nav-link">Learn</a>',
            '<a href="contribute" class="nav-link">Contribute</a>'
        ], false);
        $mainLinksUl->getChild(0)->setClassName('nav-item');
        $mainLinksUl->getChild(1)->setClassName('nav-item');
        $mainLinksUl->getChild(2)->setClassName('nav-item');
        $mainLinksUl->getChild(3)->setClassName('nav-item');
        $navItemsContainer->addChild($mainLinksUl);
        
        return $header;
    }
    /**
     * 
     * @param AttributeDef $attr
     * @return type
     */
    public function createAttributeDetailsBlock($attr) {
        $node = $attr->getDetailsNode();
        $node->setClassName('row ml-2 border-left border-top border-right border-bottom', false);
        $node->getChildByID('attribute-'.$attr->getName().'-name')->setClassName('col-12', false);
        $node->getChildByID('attribute-'.$attr->getName().'-details')->setClassName('col-12', false);
        return $node;
    }
    /**
     * @param AttributeDef $attr An object of type AttributeDef.
     * @return HTMLNode
     */
    public function createAttributeSummaryBlock($attr) {
        $node = $attr->getSummaryNode();
        $node->setClassName('row ml-2 border-left border-top border-right border-bottom', false);
        $node->getChild(0)->setClassName('col-12', false);
        $node->getChild(1)->setClassName('col-12', false);
        return $node;
    }

    public function createClassDescriptionNode() {
        $class = $this->getClass();
        $node = $this->createHTMLNode(['type'=>'container-fluid']);
        $packageNode = new Paragraph();
        $packageNode->addText('<b class="mono">namespace '.$class->getNameSpace().'</b>',array('esc-entities'=>false));
        $node->addChild($packageNode);
        $titleNode = $this->createHTMLNode([
            'type'=>'page-title',
            'title'=>$class->getSignature()
        ]);
        $node->addChild($titleNode);
        $descNode = new HTMLNode();
        $descNode->setAttribute('class', 'description-box');
        $descNode->addTextNode($class->getSummary().' '.$class->getDescription(),false);
        $node->addChild($descNode);
        $classV = $class->getVersion();
        if($classV !== null){
            $vNode = new Paragraph();
            $vNode->addText('Version: '.$classV);
            $node->addChild($vNode);
        }
        return $node;
    }
    /**
     * @param FunctionDef $func An object of type FunctionDef.
     * @return HTMLNode 
     */
    public function createMethodDetailsBlock($func) {
        $node = $func->getDetailsNode();
        $node->setClassName('row ml-2 border-left border-top border-right border-bottom', false);
        $node->getChildByID('method-'.$func->getName().'-signator')->setClassName('col-12', false);
        $node->getChildByID('method-'.$func->getName().'-description')->setClassName('col-12', false);
        $paramsNode = $node->getChildByID('method-'.$func->getName().'-parameters');
        if($paramsNode !== null){
            $paramsNode->setClassName('col-12', false);
        }
        $returnNode = $node->getChildByID('method-'.$func->getName().'-return');
        if($returnNode !== null){
            $returnNode->setClassName('col-12', false);
        }
        return $node;
    }
    /**
     * @param FunctionDef $func An object of type FunctionDef.
     * @return HTMLNode
     */
    public function createMethodSummaryBlock($func) {
        $node = $func->getSummaryNode();
        $node->setClassName('row ml-2 border-left border-top border-right border-bottom', false);
        $node->getChild(0)->setClassName('col-12', false);
        $node->getChild(1)->setClassName('col-12', false);
        return $node;
    }
    /**
     * @param NameSpaceAPI $nsObj An object of type NameSpaceAPI.
     * @return HTMLNode The function must be implemented in a way that it returns 
     */
    public function createNamespaceContentBlock($nsObj) {
        $pageTitle = $this->createHTMLNode(['type'=>'page-title',
            'title'=>$nsObj->getName()]);
        $node = new HTMLNode();
        $node->setClassName('container-fluid');
        $node->addChild($pageTitle);
        $nsArr = $nsObj->getSubNamespaces();
        if(count($nsArr) != 0){
            $subNsNode = new HTMLNode();
            $subNsNode->setClassName('sub-ns-container');
            $label = new Paragraph();
            $label->addText('Nested Namespaces:');
            $label->setClassName('block-title');
            $subNsNode->addChild($label);
            foreach ($nsArr as $nsName){
                $cNode = new HTMLNode();
                $cNode->setClassName('row ml-2 border-left border-top border-right border-bottom');
                $link = new Anchor($this->getBaseURL().str_replace('\\', '/', $nsName), $nsName);
                $link->setClassName('attribute-name col-12');
                $cNode->addChild($link);
                $subNsNode->addChild($cNode);
            }
            $node->addChild($subNsNode);
        }
        $interfaces = $nsObj->getInterfaces();
        if(count($interfaces) != 0){
            $interfacesNode = new HTMLNode();
            $interfacesNode->setClassName('interfaces-container');
            $label = new Paragraph();
            $label->addText('All Interfaces:');
            $label->setClassName('block-title');
            $interfacesNode->addChild($label);
            foreach ($interfaces as $interface){
                $cNode = new HTMLNode();
                $cNode->setClassName('row ml-2 border-left border-top border-right border-bottom');
                $link = new Anchor($this->getBaseURL().str_replace('\\', '/', trim($nsObj->getName(),'\\')).'/'.$interface->getName(), $interface->getName());
                $link->setClassName('description attribute-name col-12');
                $cNode->addChild($link);
                $descNode = new Paragraph();
                $descNode->setClassName('description attribute-description col-12');
                $descNode->addText($interface->getSummary(),['esc-entities'=>false]);
                $cNode->addChild($descNode);
                $interfacesNode->addChild($cNode);
            }
            $node->addChild($interfacesNode);
        }
        $classes = $nsObj->getClasses();
        if(count($classes) != 0){
            $classesNode = new HTMLNode();
            $classesNode->setClassName('classes-container');
            $label = new Paragraph();
            $label->addText('All Classes:');
            $label->setClassName('block-title');
            $classesNode->addChild($label);
            foreach ($classes as $class){
                $cNode = new HTMLNode();
                $cNode->setClassName('block');
                $cNode->setClassName('row ml-2 border-left border-top border-right border-bottom');
                $link = new Anchor($this->getBaseURL().str_replace('\\', '/', trim($nsObj->getName(),'\\')).'/'.$class->getName(), $class->getName());
                $link->setClassName('description attribute-name col-12');
                $cNode->addChild($link);
                $descNode = new Paragraph();
                $descNode->setClassName('description attribute-description col-12');
                $descNode->addText($class->getSummary(),['esc-entities'=>false]);
                $cNode->addChild($descNode);
                $classesNode->addChild($cNode);
            }
            $node->addChild($classesNode);
        }
        return $node;
    }

    public function createNSAside($links) {
        return $this->createHTMLNode([
            'type'=>'vertical-nav-bar',
            'sub-lists'=>$links
        ]);
    }

}
return __NAMESPACE__;
