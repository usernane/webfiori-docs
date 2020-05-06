<?php
namespace webfiori\views;
use webfiori\entity\Page;
use webfiori\views\WebFioriPage;
use phpStructs\html\PNode;
use phpStructs\html\UnorderedList;
use webfiori\WebFiori;
/**
 * Description of WebFioriHome
 *
 * @author Ibrahim
 */
class WebFioriHome extends WebFioriPage{
    public function __construct() {
        parent::__construct();
        Page::title('WebFiori Home');
        Page::siteName('WebFiori Framework');
        Page::description('WebFiori Framework. Built to make the web blooming.');
        $parag1 = new PNode();
        
        $parag1->addText('Do you want to build a website with customizable user interface? ');
        $parag1->addLineBreak();
        $parag1->addText('Do you want to build a complicated web application with session '
                . 'management and database access? ');
        $parag1->addText('Do you want to build web APIs for your mobile app? ');
        $parag1->addLineBreak();
        $parag1->addText('If this is the case, then <em>WebFiori Framework</em> is your choice.', array('esc-entities'=>FALSE));
        Page::insert($parag1);
        $this->createSec1();
        $this->createSec4();
        $this->createSec2();
        //$this->createSec3();
        Page::render();
    }
    public function createSec4() {
        $sec = $this->createSection('Downloading The Framework',3);
        $sec->addChild($this->createParagraph('Please go to <a href="'.WebFiori::getSiteConfig()->getBaseURL().'download">downloads page</a> to check the available '
                . 'download options. After completing the download process, you can '
                . 'go to <a href="learn" >learning center</a> in order to get started.'));
        $sec->addChild($this->createParagraph('In addition to the pre-made package, you can use '
                . 'composer to download the framework and its dependencies. just issue the '
                . 'following composer command to download the framework:'));
        $sec->addChild($this->createParagraph('<code>composer require webfiori/framework</code>'));
        Page::insert($sec);
    }
    public function createSec2(){
        $sec = $this->createSection('Is it free to use?',3);
        $sec->addChild($this->createParagraph('Yes for sure. You can use it for free of charge. In '
                . 'addition, it is open source. This means you can modify the '
                . 'source code of the framework the way you like as long as you '
                . 'follow MIT license regarding open source software modifications.'));
        Page::insert($sec);
    }
    public function createSec3(){
        $sec = $this->createSection('Why did you build such framework since there are many '
                . 'good ones already out there?',3);
        $sec->addChild($this->createParagraph('One of the reasons is <b>simplicity</b>. '
                . 'Some of the available frameworks makes it difficult for you '
                . 'to develop your website or web application by overwhelming you '
                . 'with many features which you don\'t actually need. WebFiori Framework '
                . 'gives you the simplest set of tools that you would need to setup a '
                . 'website, web application or web APIs.'));
        $sec->addChild($this->createParagraph('Another reason is the <b>ease of use</b>. '
                . 'Many of the available frameworks aren\'t easy to master in '
                . 'short time. While developing the framework, one of the things that '
                . 'we put in mind is how to help developers learn how to use the '
                . 'framework in no time. If you want to create static web pages (HTML only), then '
                . 'you only need to learn about routing. You might need to learn '
                . 'more if you want to use PHP features for your web pages. '
                . 'If you want to create a nice looking pages, You need to learn '
                . 'about the basics of theming in the framework. If you want to '
                . 'develop web APIs, Then you need to learn about routing plus creating '
                . 'API classes.'));
        $sec->addChild($this->createParagraph('The final reason is <b>learning</b>. While building '
                . 'the framework, I (The developer of the framework) learned many '
                . 'new concepts which I did not know about while I was student '
                . 'at university. Building something new from scratch was a good '
                . 'chance to learn new things and to put my skills into something that can help me and others.'));
        Page::insert($sec);
    }
    private function createSec1(){
        $sec = $this->createSection('What is WebFiori Framework?',3);
        $sec->addChild($this->createParagraph('WebFiori Framework is new web framework which is built using '
                . 'PHP language. The framework is fully object oriented (OOP). '
                . 'It allows the use of the famous model-view-controller (MVC) model '
                . 'but it does not '
                . 'force it. The framework comes with many features which can '
                . 'help in making your website or web application up and running '
                . 'in no time. Some of the key features are:'));
        
        $ul = new UnorderedList();
        $ul->addListItems([
            'Theming and the ability to create multiple UIs for the same web page using any CSS or JavaScript framework.',
            'Support for routing that makes the ability of creating search-'
                . 'engine-friendly links an easy task.',
            'Creation of web APIs that supports JSON, data filtering and '
                . 'validation.',
            'Basic support for MySQL schema and query building.',
            'Lightweight. The total size of framework core files is '
                . 'less than 3 megabytes.',
            'Access management by assigning system user a set '
                . 'of privileges.',
            'The ability to create and manage multiple '
                . 'sessions at once.',
            'Support for creating and sending nice-looking emails in a simple way by using SMTP '
                . 'protocol.',
            'Autoloading of user defined classes in addition to composer packages.',
            'The ability to create background tasks and let them '
                . 'run automatically.',
            'Well-defined file upload and file handling sub-system.',
            'Building and manipulating the DOM of a web page using PHP.',
            'Ability to create custom command line interface (CLI) commands.'
        ]);
        $sec->addChild($ul);
        Page::insert($sec);
    }
}
new WebFioriHome();
