<?php
/*
 * SimpleFadeSlideShow.php
 *
 * Copyright 2014 Philipp Roggan <fss@it.dyndns.pro>
 *
 * Dual licensed under GPLv3+ and MIT
 * See License
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * and the MIT license used for this program along with this program;
 * if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 *
 * This Yii extension wraps the jQuery plugin "Simple FadeSlideShow"
 * from Pascal Bajorat [http://www.simplefadeslideshow.com/]
 * which itself also comes dual licensed under GPLv3+ and MIT
 *
 * @license GPLv3+ & MIT
 * @copyright Copyright &copy; 2014 Philipp Roggan
 * @link https://github.com/schlypel/Yii-SimpleFadeSlideShow
 *
 */

 /**
  *	Set
  */
class SimpleFadeSlideShow extends CWidget{

	// options from original jQuery plugin
	public $width = 640;
	public $height = 480;
	public $speed = 'slow'; // speed of animation (jQuery animation values are allowed)
	public $interval = 3000; // delay between changes (ms)
	public $PlayPauseElement = 'fssPlayPause'; // id for pause/play element
	public $PlayText = 'Play'; // play text
	public $PauseText = 'Pause'; // pause text
	public $NextElement = 'fssNext'; // id for next button
	public $NextElementText = 'Next >'; // text on next button
	public $PrevElement = 'fssPrev'; // id for previous button
	public $PrevElementText = '< Prev'; // text on previous button
	public $ListElement = 'fssList'; // id for the list element
	public $ListLi = 'fssLi'; // class to assign to each list element
	public $ListLiActive = 'fssActive'; // class to assign to the active list element
	public $addListToId = false; // insert image list into a html element with this id (false to not wrap)
	public $allowKeyboardCtrl = true; // should left and right arrow keys control image flow
	public $autoPlay = true; // autoplay active

	public $pathToCss = false; // use this to overwrite the default css
	//public $pathToArrowImage = false; // use this to overwrite the default arrows image

	public $images; // add images as array: [<url1>,<url2>] || [['src'=><url1>,'href'=><link1>,'text'=><title1>],['src'=><url2>,'href'=><link2>,'text'=><title2>]]

	protected function registerClientScript(){

        $assetsPath = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('ext.SimpleFadeSlideShow.assets'));

		$cssFile = ($this->pathToCss)?$this->pathToCss:$assetsPath."/default.css";
		$jsFile = $assetsPath."/simplefadeslideshow/fadeSlideShow.js";

        Yii::app()->clientScript->registerCoreScript('jquery');
        $cs = Yii::app()->clientScript;
        $cs->registerCssFile($cssFile);
        $cs->registerScriptFile($jsFile,CClientScript::POS_END);

        $this->autoPlay = ($this->autoPlay)?'true':'false';
        $this->allowKeyboardCtrl = ($this->allowKeyboardCtrl)?'true':'false';
        $cs->registerScript('startSimpleFadeSlideShow',"
			;jQuery('#simpleFadeSlideShow_images').fadeSlideShow({
				width: ".$this->width.",
				height: ".$this->height.",
				speed: '".$this->speed."',
				interval: ".$this->interval.",
				PlayPauseElement: '".(string)$this->PlayPauseElement."',
				PlayText: '".(string)$this->PlayText."',
				PauseText: '".(string)$this->PauseText."',
				NextElement: '".(string)$this->NextElement."',
				NextElementText: '".(string)$this->NextElementText."',
				PrevElement: '".(string)$this->PrevElement."',
				PrevElementText: '".(string)$this->PrevElementText."',
				ListElement: '".(string)$this->ListElement."',
				ListLi: '".(string)$this->ListLi."',
				ListLiActive: '".(string)$this->ListLiActive."',
				addListToId: '".(string)$this->addListToId."',
				allowKeyboardCtrl: ".$this->allowKeyboardCtrl.",
				autoplay: ".$this->autoPlay."
			})
        ",CClientScript::POS_READY);
    }

    public function init() {
		if (is_array($this->images)){
			parent::init();
			$this->registerClientScript();
		}
    }

    public function run(){
		if (is_array($this->images)){
			$this->render('simpleFadeSlideShow', array('images'=>$this->images));
		}else{
			echo '<!--  SimpleFadeSlideShow Widget was loaded without an array of images, no slideshow to see here!  -->';
		}
		parent::run();
	}
}
?>
