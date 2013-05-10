<?php
class VModel {
	/**
	 * upload once file
	 * @param $name
	 */
	public function upload($name){
		return $this->processUpload($name, false);
	}
	/**
	 * upload multi file
	 * @param $name
	 */
	public function uploads($name){
		return $this->processUpload($name);
	}
	/**
	 * process upload files
	 * @param $name
	 * @param $multi
	 */
	private function processUpload($name, $multi = true){
		if($multi==true){
			$rFiles = array();
			$files = CUploadedFile::getInstancesByName($name);
			if (isset($files) && count($files) > 0) {						
				foreach ($files as $key => $fil) {				
					$rFiles[] = $this->singleUpload($fil);
				}
				return $rFiles;
			}
		}else {
			$file = CUploadedFile::getInstanceByName($name);
			if (isset($file) && count($file) > 0) {
				return $this->singleUpload($file);
			}
		}
		return false;
	}
	/**
	 * single upload
	 * @param $fil
	 */
	private function singleUpload($fil){
		$pUpload = Yii::app()->params->uploads;
		$fUpload = $this->getFolder(Yii::getPathOfAlias('pathroot').DS.'uploads');
		$photosUpload = $this->getFolder($fUpload.DS.'photos'.DS);
		$videosUpload = $this->getFolder($fUpload.DS.'videos'.DS);
		$flashUpload = $this->getFolder($fUpload.DS.'flash'.DS);
		if(in_array(strtolower($fil->extensionName), $pUpload['photos']['extension'])){
			$filePath = $photosUpload;
			$fType = 'photo';
		}
		if(in_array(strtolower($fil->extensionName), $pUpload['videos']['extension'])){
			$filePath = $videosUpload;
			$fType = 'video';
		}
		if(in_array(strtolower($fil->extensionName), $pUpload['flash']['extension'])){
			$filePath = $flashUpload;
			$fType = 'flash';
		}
		
		list($width, $height, $type, $attr)=getimagesize($fil->tempName);
		$file_name = date ( 'd-m-Y-CV-h-i-s-A', time () ).uniqid();
		$new_filename = $file_name.'.'.strtolower($fil->extensionName);
		if ($fil->saveAs($filePath.$new_filename)) {
			$suFile = array(
				'images'=>str_replace(Yii::getPathOfAlias('pathroot'), '', $filePath.$new_filename),
				'params'=>array(
								'file'=>array(
									'name'=>$fil->getName(),
									'type'=>$fil->getType(),
									'size'=>$fil->getSize(),
									'width'=>$width,
									'height'=>$height,
									'extension'=>$fil->getExtensionName(),
								)
							),
			);
			return $suFile;
		}
	}
	/**
	 * generate wallpaper with photo exist
	 * @param Files $fil
	 */
	public function generateWallpaper(Files $fil){
		$pUpload = Yii::app()->params->uploads;
		if(!empty($pUpload['photos']['resolutions']) && !empty($fil->params) && $fil->type=='photo'){
			$params = json_decode($fil->params);
			$file_name = $params->file->name;
			$photo_name = str_replace('.'.$params->file->extension, '', $params->file->name);			
			if(!empty($fil->path) && !empty($file_name)){	
				$filePath = str_replace($file_name, '', Yii::getPathOfAlias('pathroot').DS.$fil->path);
			} 
			$resolutions = $pUpload['photos']['resolutions'];
			/* wallpaper with multi resolution */
			foreach ($resolutions as $resolution){
				$new_photo_name = $photo_name.'_'.$resolution.'.'.$params->file->extension;				
				list($width, $height)=explode('_', $resolution);				
				$image = Yii::app()->image->load($filePath.$file_name);
			    $image->resize($width, $height, 1);
			    if($image->save($filePath.$new_photo_name)){
			    	/* save wallpaper */
			    	$wallpaper = new Wallpaper();
			    	$wallpaper->file_id = $fil->id;
			    	$wallpaper->width = $width;
			    	$wallpaper->height = $height;
			    	$wallpaper->mime = $params->file->type;
			    	$wallpaper->photo_name = $new_photo_name;
			    	$wallpaper->photo_path = str_replace(Yii::getPathOfAlias('pathroot').DS, '', $filePath.$new_photo_name);
			    	$wallpaper->ext = $params->file->extension;
			    	$wallpaper->save();
			    }
			}
		}
	}
	/**
	 * insert/update file
	 * @param $pFiles
	 */
	public function insertFiles($pFiles){
		if(!empty($pFiles)){
			$gfiles = new Files();
			$gfiles->attributes = $pFiles;
			if(!$gfiles->hasErrors()){
				if($gfiles->isNewRecord){
					$gfiles->created = time();
				}
				if($gfiles->save()){
					return $gfiles;
				}
			} 
		}
	}
	/**
	 * get folder
	 * @param $path
	 */
	private function getFolder($path){
		if(!is_dir($path)){
			mkdir($path);
			chmod($path, 775);				
		}
		return $path;
	}
	/**
	 * parse data for function manage file
	 * @param Files $data
	 * @param $attributes
	 */
	public static function parseDataFiles(Files $data, $attributes){
		$baseUrl = str_replace('admin', '', Yii::app()->createAbsoluteUrl('') );
		if(!empty($attributes)){
			switch ($attributes){
				case 'path':
					if($data->type == 'photo'){
						echo CHtml::image($baseUrl .$data->path, $data->description, array("class" => "gImg", "title" => $data->title, "width"=>"70"));
					}
					break;
				case 'album_id':
					$title = '';
					$album = Album::model()->findByPk($data->album_id);
					if(!empty($album)){
						$title = $album->title;						
					}
					echo $title;
					break;
				case 'user_id':
					$user = YumUser::model()->findByPk($data->user_id);
					if(!empty($user)){
						echo $user->username;						
					}
					break;
				default:
					break;
			}
		}
	}
}

?>