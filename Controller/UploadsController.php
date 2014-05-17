<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'php-excel-reader/excel_reader2');
App::import('Vendor', 'PHPExcel_IOFactory', array('file' => 'PHPExcel/Classes/PHPExcel/IOFactory.php'));
/**
 * Files Controller
 *
 * @property User $User
 */
class UploadsController extends AppController {


	public $components = array('UploadService', 'RequestHandler');
	public $uses = array('Upload', 'Participant', 'Stimulus','Response', 'Experiment', 'Attribute', 'EntityAttributeValue');

	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index(){

	}

	public function add(){
		$msg="";
		$id = $this->Stimulus->find('first', array(
				'fields' => 'Stimulus.id',
				'conditions' => array('Stimulus.name' => $this->request->data['Stimulus']['name'], 'Stimulus.category' =>  $this->request->data['Stimulus']['category'])
		));
		if(isset($id['Stimulus']['id'])){
			$this->Stimulus->id = $id['Stimulus']['id'];
			$msg = "The Stimulus exists;<br/>";
		} else {
			$stimulus = array();
			$this->Stimulus->create();
			$stimulus['Stimulus']['name'] = $this->request->data['Stimulus']['name'];
			$stimulus['Stimulus']['category'] = $this->request->data['Stimulus']['category'];
			$this->Stimulus->save($stimulus);
		}
		$id = $this->Participant->find('first', array(
				'fields' => 'Participant.id',
				'conditions' => array('Participant.uid' => $this->request->data['Participant']['uid'])
		));
		if(isset($id['Participant']['id'])){
			$this->Participant->id = $id['Participant']['id'];
			$msg = "The participant exists;<br/>";
		} else {
			$participant = array();
			$this->Participant->create();
			$participant['Participant']['uid'] = $this->request->data['Participant']['uid'];
			$participant['Participant']['name'] = $this->request->data['Participant']['name'];
			$participant['Participant']['age'] = $this->request->data['Participant']['age'];
			$participant['Participant']['race'] = $this->request->data['Participant']['race'];
			$this->Participant->save($participant);
		}
		$response = array();
		$this->Response->create();
		$response['Response']['experiment_id'] = $this->Session->read('Experiment.id');
		$response['Response']['participant_id'] = $this->Participant->id;
		$response['Response']['stimulus_id'] = $this->Stimulus->id;
		$response['Response']['response_value'] = $this->request->data['Response']['value'];
		$response['Response']['date_taken'] = $this->request->data['Response']['date'];
		$response['Response']['notes'] = $this->request->data['Response']['note'];
		$response['Response']['start_time'] = $this->request->data['Response']['start_time'];
		$response['Response']['end_time'] = $this->request->data['Response']['end_time'];
		$response['Response']['date_entered'] = date("Y-m-d H:i:s");
		if($this->Response->save($response)){
			$msg = "The experiment data has been saved!";
		}
		$this->Session->setFlash($msg, 'flash_custom', array('class' => 'alert-success'));
		$this->redirect(array('action' => 'upload'));

	}

	public function download(){

		//$objPHPExcel = new PHPExcel();
		//$objPHPExcel->setActiveSheetIndex(0);
		//$this->Response->recursive = -1;
		$responses = $this->Response->find('all', array('conditions' => array('Response.experiment_id' => $this->Session->read('Experiment.id'))));
		$participantUID = $this->Attribute->find('first', array('conditions' => array('Attribute.project_id' => $this->Session->read('Project.id'), 'Attribute.type' => 'Participant UID')));
		$stimulusName = $this->Attribute->find('first', array('conditions' => array('Attribute.experiment_id' => $this->Session->read('Experiment.id'), 'Attribute.type' => 'Stimulus Name')));
		$responseValue = $this->Attribute->find('first', array('conditions' => array('Attribute.experiment_id' => $this->Session->read('Experiment.id'), 'Attribute.type' => 'Response Value')));
		

		$participantIdSet = array();
		$stimulusIdSet = array();
		$responseIdSet = array();

		foreach($responses as $response) {
			$participantIdSet[$response['Response']['participant_id']] = 0;
			$stimulusIdSet[$response['Response']['stimulus_id']] = 0;
			$responseIdSet[$response['Response']['id']] = 0;
		}

		$participantAttributeValues = $this->EntityAttributeValue->find('all', array('conditions' => array('EntityAttributeValue.entity_id' => array_keys($participantIdSet))));
		$participants = array();
		$participantAttributes = array();
		foreach($participantAttributeValues as $eav){
			$participants[$eav['EntityAttributeValue']['entity_id']][$eav['Attribute']['name']] = $eav['EntityAttributeValue']['value'];
			$participantAttributes[$eav['Attribute']['name']] = $eav['Attribute']['description'];
		}
		unset($participantAttributeValues);

		$stimulusAttributeValues = $this->EntityAttributeValue->find('all', array('conditions' => array('EntityAttributeValue.entity_id' => array_keys($stimulusIdSet))));
		$stimuli = array();
		$stimulusAttributes = array();
		foreach($stimulusAttributeValues as $eav){
			$stimuli[$eav['EntityAttributeValue']['entity_id']][$eav['Attribute']['name']] = $eav['EntityAttributeValue']['value'];
			$stimulusAttributes[$eav['Attribute']['name']] = $eav['Attribute']['description'];
		}
		unset($stimulusAttributeValues);
		
		$responseAttributeValues = $this->EntityAttributeValue->find('all', array('conditions' => array('EntityAttributeValue.entity_id' => array_keys($responseIdSet))));
		$responseEAVs = array();
		$responseAttributes = array();
		foreach($responseAttributeValues as $eav){
			$responseEAVs[$eav['EntityAttributeValue']['entity_id']][$eav['Attribute']['name']] = $eav['EntityAttributeValue']['value'];
			$responseAttributes[$eav['Attribute']['name']] = $eav['Attribute']['description'];
		}
		unset($responseAttributeValues);
		/*
		 //write header
		$rowCount = 1;

		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, 'Participant ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, 'Stimulus Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, 'Response Value');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, 'Date Taken');
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'Start Time');
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, 'End Time');
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'Misc. Note');
		//write row
		$rowCount++;
		foreach($responses as $response) {
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $response['Participant']['uid']);
		$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $response['Stimulus']['name']);
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $response['Response']['response_value']);
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $response['Response']['date_taken']);
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $response['Response']['start_time']);
		$objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $response['Response']['end_time']);
		$objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $response['Response']['misc_note']);
		$rowCount++;
		}
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		*/

		$data = array();
		$header = array();
		$header[] = $participantUID['Attribute']['name'];
		$header = array_merge($header, array_keys($participantAttributes));
		$header[] = isset($stimulusName['Attribute']['name'])? $stimulusName['Attribute']['name'] : "Stimulus Name" ;
		$header = array_merge($header, array_keys($stimulusAttributes));
		$header[] = isset($responseValue['Attribute']['name'])? $responseValue['Attribute']['name'] : "Response Value" ;
		$header = array_merge($header, array_keys($responseAttributes));
		$data[] = $header;

		foreach($responses as $response) {
			$row = array();
			$row[] =  $response['Participant']['uid'];
			foreach(array_keys($participantAttributes) as $att){
				if(isset($participants[$response['Response']['participant_id']][$att])){
					$row[] = $participants[$response['Response']['participant_id']][$att];
				} else {
					$row[] = "";
				}
			}
			$row[] =  $response['Stimulus']['name'];
			foreach(array_keys($stimulusAttributes) as $key){
				if(isset($stimuli[$response['Response']['stimulus_id']][$key])){
					$row[] = $stimuli[$response['Response']['stimulus_id']][$key];
				} else {
					$row[] = "";
				}
			}
			$row[] =  $response['Response']['response_value'];
			foreach(array_keys($responseAttributes) as $key){
				if(isset($responseEAVs[$response['Response']['id']][$key])){
					$row[] = $responseEAVs[$response['Response']['id']][$key];
				} else {
					$row[] = "";
				}
			}
			array_push($data, $row);
		}
		unset($responses);
		//$objWriter->save($this->Session->read('Experiment.name') . '_data.xlsx');

		// We'll be outputting an excel file
		//		header('Content-type: application/vnd.ms-excel');
		//		header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

		// It will be called file.xls
		//		header('Content-Disposition: attachment; filename="' . $this->Session->read('Experiment.name') . '_data.xlsx"');

		//		$objWriter->save('php://output');

		$this->autoRender = false;


		header("Content-type: text/csv");
		header("Cache-Control: no-store, no-cache");
		header('Content-Disposition: attachment; filename="' . $this->Session->read('Experiment.name') . '_data.csv"');

		$outstream = fopen("php://output",'w');

		foreach( $data as $row ) {
			fputcsv($outstream, $row, ',', '"');
		}
		fclose($outstream);
	}

	public function upload($id = null){
		$this->set('title_for_layout', 'Upload Experiment Data');


		$stimuliStr = "Stimulus: Statements of each topics in Aleks System";
		$responseStr = "Response: Attempted and Mastered.";

		$this->set('stimuliStr', $stimuliStr);
		$this->set('responseStr', $responseStr);

		if($id != null){
			$this->loadModel('Experiment');
			$this->Experiment->id = $id;
			$this->Session->write('Experiment.id', $id);
			$this->Session->write('Experiment.name', $this->Experiment->field('name'));
			$this->Session->write('Experiment.description', $this->Experiment->field('description'));
		}
	}

	public function handler(){

		$this->layout = 'empty';

		header('Pragma: no-cache');
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header('Content-Disposition: inline; filename="files.json"');
		header('X-Content-Type-Options: nosniff');
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
		header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

		switch ($_SERVER['REQUEST_METHOD']) {
			case 'OPTIONS':
				break;
			case 'HEAD':
			case 'GET':
				$project_id = $this->Session->read('Project.id');
				$experiment_id = $this->Session->read('Experiment.id');
				$conditions = array('Upload.project_id' => $project_id);
				if(isset($experiment_id)){
					$conditions[] = array('Upload.experiment_id' => $experiment_id);
				}
				$files = $this->Upload->find('all', array('fields' => array('Upload.name'), 'conditions' => $conditions));
				$files = Set::extract($files, '{n}.Upload');
				$this->UploadService->get($files);
				break;
			case 'POST':
				if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
					$this->UploadService->delete();
				} else {
					$this->UploadService->post();
				}
				break;
			case 'DELETE':
				$this->UploadService->delete();
				break;
			default:
				header('HTTP/1.1 405 Method Not Allowed');
		}
	}

	public function getColumns(){

		// 		header('Content-Type: text/event-stream');
		// 		header('Cache-Control: no-cache');

		// 		echo "data: The server time is: {$time}\n\n";
		// 		flush();
		//header('Content-Type: text/event-stream');
		//header('Cache-Control: no-cache');
		$this->debug("In getColumns");
		$files = $this->Upload->find('all', array( 'conditions' => array( 'Upload.status' => 0)));
		$columns ='';
		$columnArray = array();
		foreach($files as $file) {
			$file['Upload']['status'] = 1;
			$this->Upload->save($file);
			//$data = new Spreadsheet_Excel_Reader(WWW_ROOT. 'files' . DS . $file['Upload']['name'], false);
			//assume .xlsx format
			//$objReader = new PHPExcel_Reader_Excel2007();
			$objPHPExcel = PHPExcel_IOFactory::load(WWW_ROOT. 'files' . DS . $file['Upload']['name']);
			$worksheet = $objPHPExcel->getSheet(0);
			//$objReader->setReadDataOnly( true );
			//$phpExcel = $objReader->load(WWW_ROOT. 'files' . DS . $file['Upload']['name']);
			//mutiple sheet
			//$worksheet = $phpExcel->getSheet(0);
			if(!empty($worksheet)){
				//begin processing files
				$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
				$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
				//push label vals into header array - index = col index, value = label
				for ($col = 0; $col < $highestColumnIndex; $col++) {
					$cell = $worksheet->getCellByColumnAndRow($col, 1);
					$val = $cell->getValue();
					$columns .= '<input type="text" draggable="true" id="'. $col. '" ondragstart="dragIt(this, event)" value="' . $val . '"/>';
					$columnArray[$col] = $val;
				}
			}
		}
		$this->debug(json_encode($columnArray));
		//echo json_encode($columnArray);

		if(strlen($columns) > 0){
			echo $columns;
		}

		$this->autoRender = false;
	}

	public function map(){
		$this->autoRender = false;
		$responses = array();
		$data = $this->request->input('json_decode', true);
		$attributes = array();
		$files = $this->Upload->find('all', array( 'conditions' => array( 'Upload.status' => 1, 'Upload.project_id' => $this->Session->read('Project.id'))));
		$msg = "No Data Uploaded.";
		foreach($files as $file) {
			$file['Upload']['status'] = 2;
			$this->Upload->save($file);
			$objPHPExcel = PHPExcel_IOFactory::load(WWW_ROOT. 'files' . DS . $file['Upload']['name']);
			$worksheet = $objPHPExcel->getSheet(0);
			if(!empty($worksheet)){
				$highestRow = $worksheet->getHighestRow();
				
				//Save participant attributes AND Entity-Attribute-Value
				foreach ($data['participant']['attributes'] as $key => $value) {
					$attributes['Participant'][$value] = $this->saveAttribute($value, 'Participant Attribute');
				}
				$this->saveAttribute($data['participant']['uid_name'], 'Participant UID', '');
				//Save stimulus attributes AND Entity-Attribute-Value
				foreach ($data['stimulus']['attributes'] as $key => $value) {
					$attributes['Stimulus'][$value] = $this->saveAttribute($value, 'Stimulus Attribute');
				}
				if(isset($data['stimulus']['name_name'])){
					$this->saveAttribute($data['stimulus']['name_name'], 'Stimulus Name', '');
				}
				//Save response attributes AND Entity-Attribute-Value
				foreach ($data['response']['attributes'] as $key => $value) {
					$attributes['Response'][$value] = $this->saveAttribute($value, 'Response Attribute');
				}
				if(isset($data['response']['value_name'])){
					$this->saveAttribute($data['response']['value_name'], 'Response Value', '');
				}
				
				$pIdSet = array();
				$sIdSet = array();
				for ($row = 2; $row <= $highestRow; $row++) {
					//SAVE Participant
					$pID = null;
					if(isset($data['participant']['uid'])){
						$cell = $worksheet->getCellByColumnAndRow($data['participant']['uid'], $row);
						$pID = $cell->getFormattedValue();
						if(!isset($pIdSet[$pID])){		
							$pIdSet[$pID] = $this->saveParticipant($pID, $this->Session->read('Project.id'));
						}
						foreach ($data['participant']['attributes'] as $key => $value) {
							$cell = $worksheet->getCellByColumnAndRow($key, $row);
							$this->saveEntityAttributeValue($pIdSet[$pID], $attributes['Participant'][$value], $cell->getFormattedValue(), "Participant");
						}
					}
					//SAVE Stimulus
					$name = null;
					if(isset($data['stimulus']['name'])){
						$cell = $worksheet->getCellByColumnAndRow($data['stimulus']['name'], $row);
						$name = $cell->getFormattedValue();
						if(!isset($sIdSet[$name])){							
							$sIdSet[$name] = $this->saveStimulus($name, $this->Session->read('Experiment.id'));
						}
						foreach ($data['stimulus']['attributes'] as $key => $value) {
							$cell = $worksheet->getCellByColumnAndRow($key, $row);
							$this->saveEntityAttributeValue($sIdSet[$name], $attributes['Stimulus'][$value], $cell->getFormattedValue(), "Stimulus");
						}
					}
					//SAVE Response
					if(isset($data['response']['value'])){
						$cell = $worksheet->getCellByColumnAndRow($data['response']['value'], $row);
						$response_id = $this->saveResponse($cell->getFormattedValue(), $pIdSet[$pID], $sIdSet[$name], $this->Session->read('Experiment.id'));
						foreach ($data['response']['attributes'] as $key => $value) {
							$cell = $worksheet->getCellByColumnAndRow($key, $row);
							$this->debug("Response ID: " . $response_id . " Attribute ID: " . $attributes['Response'][$value]);
							$this->saveEntityAttributeValue($response_id, $attributes['Response'][$value], $cell->getFormattedValue(), "Response");
						}
					}
				}
				//$responses['msg'] = "Uploaded " . ($row -1) . " Records.";
				$msg = "Uploaded " . ($row -1) . " Responses.";
			}
		}
		$this->autoRender = false;
		echo json_encode(array(
				'status' => 'success',
				'message'=> $msg
		));
	}

	public function saveParticipant($id, $project_id) {
		$pid = $this->Participant->find('first', array('fields' => 'id', 'conditions' => array('uid' => $id, 'project_id' => $project_id)));
		if(isset($pid['Participant']['id'])){
			return $pid['Participant']['id'];
		} else {
			$participant = array();
			$this->Participant->create();
			$participant['Participant']['uid'] = $id;
			$participant['Participant']['project_id'] = $project_id;
			if($this->Participant->save($participant)){
				return $this->Participant->id;
			} else {
				$this->debug("Save Participant failed!");
				return null;
			}
		}
	}

	public function saveStimulus($name = null, $experiment_id = null) {
		$this->debug("Start to save stimulus...");
		$id = $this->Stimulus->find('first', array(
				'fields' => 'Stimulus.id',
				'conditions' => array('Stimulus.name' => $name, 'Stimulus.experiment_id' => $experiment_id)
		));
		if(isset($id['Stimulus']['id'])){
			return $id['Stimulus']['id'];
		} else {
			$stimulus = array();
			$this->Stimulus->create();
			$stimulus['Stimulus']['name'] = $name;
			$stimulus['Stimulus']['experiment_id'] = $experiment_id;
			if($this->Stimulus->save($stimulus)){
				return $this->Stimulus->id;
			} else {
				$this->debug("Save Stimulus failed!");
				return null;
			}
		}
	}

	public function saveResponse($value = null, $participant_id = null, $stimulus_id = null, $experiment_id) {
		$response = array();
		$this->Response->create();
		$response['Response']['response_value'] = $value;
		$response['Response']['participant_id'] = $participant_id;
		$response['Response']['stimulus_id'] = $stimulus_id;
		$response['Response']['experiment_id'] = $experiment_id;
		$response['Response']['date_entered'] = date( "Y-m-d H:i:s" );
		if($this->Response->save($response)){
			return $this->Response->id;
		} else {
			$this->debug("Save Response failed!");
			return null;
		}
	}

	public function saveAttribute($name = null, $type = null, $description = null) {
		if(strstr($type,"Participant")){
			$conditions = array('Attribute.project_id' => $this->Session->read("Project.id"), 'Attribute.name' => $name, 'Attribute.type' => $type);
		} else {
			$conditions = array('Attribute.experiment_id' => $this->Session->read("Experiment.id"), 'Attribute.name' => $name, 'Attribute.type' => $type);
		}	
		$attribute = $this->Attribute->find('first', array('fields' => 'Attribute.id', 'conditions' => $conditions));		
		if(isset($attribute['Attribute']['id'])){
			return $attribute['Attribute']['id'];
		} else if(isset($name)){
			$attribute = array();
			$this->Attribute->create();
			$attribute['Attribute']['name'] = $name;
			$attribute['Attribute']['project_id'] = $this->Session->read('Project.id');
			$attribute['Attribute']['experiment_id'] = $this->Session->read('Experiment.id');
			$attribute['Attribute']['type'] = $type;
			$this->Attribute->save($attribute);
			return $this->Attribute->id;
		} else {
			return false;
		}
	}

	public function saveEntityAttributeValue($entity_id = null, $attribute_id = null, $value = null, $type = null) {
		if($entity_id != null && $attribute_id != null){
			$this->EntityAttributeValue->create();
			$entity_attribute = array();
			$entity_attribute['EntityAttributeValue']['entity_id'] = $entity_id;
			$entity_attribute['EntityAttributeValue']['attribute_id'] = $attribute_id;
			$entity_attribute['EntityAttributeValue']['value'] = $value;
			$entity_attribute['EntityAttributeValue']['entity_type'] = $type;
			$this->EntityAttributeValue->save($entity_attribute);
			return true;
		} else {
			return false;
		}
	}

	public function sse(){
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		$time = date('r');
		echo "data: The server time is: {$time}\n\n";
		flush();
	}

	public function test(){
		$this->layout = 'empty';
	}
}