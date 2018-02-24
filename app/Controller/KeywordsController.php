<?php
App::uses('AppController', 'Controller');
/**
 * Keywords Controller
 *
 * @property Keyword $Keyword
 * @property PaginatorComponent $Paginator
 */
class KeywordsController extends AppController {

/**
 * Components
 *
 * @var array
 */
    public $components = ['Paginator', 'Csv'];

    public function beforeSave($options = array()) {
        if (!empty($this->data['Keyword']['word'])) {

            $this->data['Keyword']['word'] = strtolower($this->data['Keyword']['word']);
        }
        return true;
    }

/**
 * index method
 *
 * @return void
 */
    public function index() {
        $paging = 10;
        $settings = [
            'limit' => 10,
            'fields' => ['*'],
            'paramType' => 'querystring',
            'order' => ['word' => 'ASC']
        ];

        $this->Paginator->settings = $settings;
        $keywords = $this->Paginator->paginate('Keyword');

        $this->set(compact('keywords'));
    }

    public function page_ajax() {
        $this->layout = false;
        $paging = 10;
        if ($this->request->is('ajax')) {
            $post_cond  = $this->request->data;

            $settings = [
                'fields' => ['*'],
                'paramType' => 'querystring',
                'conditions' => $conditions,
                'limit' => $paging,
                'order' => ['word' => 'ASC']
            ];

            $this->Paginator->settings = $settings;
            $keywords = $this->Paginator->paginate('Keyword');

        } else {
            throw new MethodNotAllowedException();
        }
        $this->set(compact('keywords'));
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->Keyword->exists($id)) {
            throw new NotFoundException(__('Invalid keyword'));
        }
        $options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
        $this->set('keyword', $this->Keyword->find('first', $options));
    }

/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            if ($this->Keyword->validates($this->request->data)) {
                $this->Keyword->create();
                if ($this->Keyword->save($this->request->data)) {
                    $this->Flash->success(__('The keyword has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The keyword could not be saved. Please, try again.'));
                }
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->Keyword->exists($id)) {
            throw new NotFoundException(__('Invalid keyword'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Keyword->validates($this->request->data)) {
                if ($this->Keyword->save($this->request->data)) {
                    $this->Flash->success(__('The keyword has been updated.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Flash->error(__('The keyword could not be updated. Please, try again.'));
                }
            }
        } else {
            $options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
            $this->request->data = $this->Keyword->find('first', $options);
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->autoRender = false;
        $this->Keyword->id = $id;
        if (!$this->Keyword->exists()) {
            throw new NotFoundException(__('Invalid keyword'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Keyword->delete()) {
            $this->Flash->success(__('The keyword has been deleted.'));
        } else {
            $this->Flash->error(__('The keyword could not be deleted. Please, try again.'));
        }
    }

     /**
     * download_csv method
     * @return void
     */
    public function download_csv() {
        try {
            $this->layout = false;
            $filename = 'Keyword_list_'.date('YmdHis');
            $modelName = 'Keyword';
            $conditions = [];
            $csv = $this->Csv->getDownloadCsvData($modelName, $conditions);
            $th = $csv['header'];
            $orderedData = $csv['data'];
            $this->set(compact('filename','th', 'orderedData', 'modelName'));
        } catch (Exception $e) {
            $this->Flash->error(__('Could not download csv. Please, try again.'));
            return $this->redirect(array('action' => 'index'));
        }
        
    }

    public function upload_csv() {
        // Upload CSV. Save data in shop table
        if( $this->request->is('post', 'ajax')){
            $this->autoRender = false;

            $file = $_FILES;

            // array for data to be add
            $dr = array();
            $row_cnt = 0;
            $err_container = [];

            // check if there are any file selected
            if (!empty($file['file-0']['name'])) {
                $filename = $file['file-0']['tmp_name'];
                //check if its csv
                $type = explode(".",$file['file-0']['name']);
                if (strtolower(end($type)) == 'csv') {
                    // open the file
                    $fp = $this->Csv->utf8_fopen_read($filename);
                    $err_cnt = 0;
                    $err_msg = array();
                    $data = [];
                    $product_names = [];

                    fgetcsv($fp, 10000, ","); // skip first line

                    while ( ($tmp_line = fgetcsv($fp)) !== false) {
                            //check column number
                            $line = explode("\t", $tmp_line[0]);
                            if (count($line) != 2){
                                $err_container[$row_cnt][] = __('Invalid number of columns.');
                                $row_cnt++;
                                continue;
                            }

                            $data['word'] = $line[0];
                            $data['point'] = $line[1];

                            if ($data['word'] == null) {
                                $err_container[$row_cnt][] = __('Keyword is required.');
                            }

                            if ($data['point'] != null && !ctype_digit($data['point'])) {
                                if ($data['point'] < 0 || $data['point'] > 5) {
                                    $err_container[$row_cnt][] = __('Point should be between 0 and 5');
                                }
                            }

                            $row_cnt++;
                            $dr[$row_cnt] = $data; // Validation message
                            $data = [];
                    }
                    // close the file
                    fclose($fp);
                } else {
                    $response['status'] = 'error';
                    $response['message'] = __('The format of the file is incorrect.');
                    return json_encode($response);
                }
            } else {
                $response['status'] = 'error';
                $response['message'] = __('CSV file is required.');
                return json_encode($response);
            }

            if ($row_cnt == 0) {
                $response['status'] = 'error';
                $response['message'] = __('No data on CSV.');
                return json_encode($response);

            } else {
                // reset Model Keyword
                $this->Keyword->clear();
                $this->Keyword->deleteAll([1]);

                if(empty($err_container)){
                    //Upload
                    $datasource = $this->Keyword->getDataSource();
                    $datasource->begin();

                    try {
                        foreach ($dr as $key => $value) {
                            $save_data = [
                                'word'   => $value['word'],
                                'point'   => $value['point'],
                                'created' => date('Y-m-d H:i:s'),
                                'modified' => date('Y-m-d H:i:s'),
                            ];
                            $this->Keyword->save($save_data);
                            $this->Keyword->clear();
                        }
                        $datasource->commit();
                        $response['status'] = 'success';
                        $this->Flash->success(__('Successfully updated'));
                    } catch(Exception $e) {
                        $datasource->rollback();
                        $response['status'] = 'error';
                        $response['message'] = $e->getMessage();
                    }

                } else {
                    $message = '';
                    foreach ($err_container as $key => $row) {
                        $message .= '<span> No.'. ($key + 1) . ': </span>';
                        foreach($row as $value){
                          $message .= $value . '<br>';
                        };
                    }
                    $response['status'] = 'errors';
                    $response['message'] = $message;
                }
                return json_encode($response);
            }
        }
    }
}
