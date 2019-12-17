<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace webfiori\views;
use webfiori\entity\Page;
use webfiori\views\WebFioriPage;
use phpStructs\html\HTMLNode;
use phpStructs\html\PNode;
use webfiori\WebFiori;
use phpStructs\html\UnorderedList;
use phpStructs\html\ListItem;
use phpStructs\html\LinkNode;
/**
 * Description of DownloadView
 *
 * @author Ibrahim
 */
class DownloadView extends WebFioriPage{
    public function __construct() {
        parent::__construct();
        parent::__construct(array(
            'title'=>'Download',
            'description'=>'Download options of WebFiori Framework.'
        ));
        $this->_stableDownloads();
        $this->_betaDownloads();
        $this->_nextSteps();
        Page::render();
    }
    private function _stableDownloads() {
        $sec = $this->createSection('Stable Releases',3);
        $sec->addChild($this->createParagraph('The latest release of the framework is version '
                . '1.0.7. You can click <a href="downloads/webfiori-v1.0.7-stable">here</a> in order to start the '
                . 'download process.'));
        Page::insert($sec);
    }
    private function _betaDownloads(){
        $sec = $this->createSection('Beta Releases and Old Releases',3);
        $sec->addChild($this->createParagraph('Here you will find all beta and historical releases. The given ones are '
                . 'not good option for production and might have bugs.'));
        $ul = new UnorderedList();
        $ul->addListItems(array(
            '<a href="downloads/webfiori-v1.0.6-stable">WebFiori v1.0.6 Stable</a>',
            '<a href="downloads/webfiori-v1.0.5-stable">WebFiori v1.0.5 Stable</a>',
            '<a href="downloads/webfiori-v1.0.4-stable">WebFiori v1.0.4 Stable</a>',
            '<a href="downloads/webfiori-v1.0.3-stable">WebFiori v1.0.3 Stable</a>',
            '<a href="downloads/webfiori-v1.0.2-stable">WebFiori v1.0.2 Stable</a>',
            '<a href="downloads/webfiori-v1.0.2-beta-1">WebFiori v1.0.2 Beta 1</a>',
            '<a href="downloads/webfiori-v1.0.0-stable">WebFiori v1.0.0 Stable</a>',
            '<a href="downloads/webfiori-v1.0.0-beta-2">WebFiori v1.0.0 Beta 2</a>',
            '<a href="downloads/webfiori-v1.0.0-beta-1">WebFiori v1.0.0 Beta 1</a>'
        ), FALSE);
        $sec->addChild($ul);
        Page::insert($sec);
    }
    private function _nextSteps(){
        $sec = $this->createSection('What is Next?',3);
        $sec->addChild($this->createParagraph('Once you finsh downloading the framework, you can visit '
                . '<a href="learn" >Learning Center</a> in order to start your development process.'));
        Page::insert($sec);
    }
}
new DownloadView();
