<?php

namespace frontend\controllers;


use common\models\LoginForm;
use frontend\models\Sales;
use frontend\models\SalesSearch;
use frontend\models\ZReportData;
use frontend\models\ZReportDataSearch;
use Yii;
use frontend\models\Report;
use frontend\models\ReportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Request;

/**
 * ReportController implements the CRUD actions for Report model.
 */
class ReportController extends Controller
{
    /**
     * @inheritdoc
     */



    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Report models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays a single Report model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Report model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Report();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Lists all JournalEntry models.
     * @return mixed
     */
    public function actionBalanceSheet()
    {
        $model = new JournalEntry();
        $assets = [];
        $liabilities = [];
        $equity = [];
        if($model->load(Yii::$app->request->post())){
            $model->branch_id = $_POST['JournalEntry']['branch_id'];
            $model->date1 = $_POST['JournalEntry']['date1'];
            $assets = JournalEntry::getAssets($model->branch_id,$model->date1);
            $liabilities = JournalEntry::getLiabilities($model->branch_id,$model->date1);
            $equity = JournalEntry::getEquity($model->branch_id,$model->date1);

            if($assets != null || $liabilities != null || $equity != null){

                return $this->render('balance_sheet', [
                    'model' => $model,'assets' => $assets,'liabilities' => $liabilities,'equity' => $equity,

                ]);
            }
        }
        return $this->render('balance_sheet', [
            'model' => $model,'assets' => $assets,'liabilities' => $liabilities,'equity' => $equity,

        ]);
    }



    /**
     * Lists all JournalEntry models.
     * @return mixed
     */
    public function actionIncomeStatement()
    {
        $model = new JournalEntry();
        $incomes = [];
        $expenses = [];
        if($model->load(Yii::$app->request->post())){
            $model->branch_id = $_POST['JournalEntry']['branch_id'];
            $model->date1 = $_POST['JournalEntry']['date1'];
            $model->date2 = $_POST['JournalEntry']['date2'];
            $incomes = JournalEntry::getIncome($model->branch_id,$model->date1,$model->date2);
            $expenses = JournalEntry::getExpenses($model->branch_id,$model->date1,$model->date2);
          //  print_r($incomes);

            if($incomes!= null || $expenses != null){

                return $this->render('income_statement', [
                    'model' => $model,'incomes' => $incomes,'expenses' => $expenses

                ]);
            }
        }

        return $this->render('income_statement', [
            'model' => $model,'incomes' => $incomes, 'expenses' => $expenses

        ]);
    }

    /**
     * Lists all JournalEntry models.
     * @return mixed
     */
    public function actionTrialBalance()
    {
        $model = new JournalEntry();
        $trialbalance = [];
        if($model->load(Yii::$app->request->post())){
            $model->branch_id = $_POST['JournalEntry']['branch_id'];
            $model->date1 = $_POST['JournalEntry']['date1'];
            $model->date2 = $_POST['JournalEntry']['date2'];
            $trialbalance = JournalEntry::getTrialBalance($model->branch_id,$model->date1,$model->date2);
            // var_dump($trialbalance);
            // exit;
            if($trialbalance!= null){

                return $this->render('trial_balance', [
                    'model' => $model,'trialbalance' => $trialbalance

                ]);
            }
        }

        return $this->render('trial_balance', [
            'model' => $model,'trialbalance' => $trialbalance

        ]);
    }




    public function actionSales()
    {

        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('sales', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }





    public function actionZReport()
    {

        $searchModel = new ZReportDataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('z_report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Updates an existing Report model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Report model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    //gets all customers
    public function actionCustomers()
    {
        if (!Yii::$app->user->isGuest) {
        $searchModel = new CustomerSearch();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);

        return $this->render('customers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    //gets all customer loans
    public function actionCustomerLoan()
    {
        if (!Yii::$app->user->isGuest) {
        $model = new Customer();
        return $this->render('customer_loan', [
            'model'=>$model
        ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    //gets all customers loans
    public function actionLoans()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ContractMasterSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('loans', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }


    //gets all  loans outstanding balances
    public function actionLoansBalances()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ContractMasterSearch();
            $dataProvider = $searchModel->searchBalances(Yii::$app->request->queryParams);

            return $this->render('loans_balances', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    //gets all  loans outstanding balances
    public function actionLoanPortifolio()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ContractMasterSearch();
            $dataProvider = $searchModel->searchBalances(Yii::$app->request->queryParams);

            return $this->render('loan_portifolio', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }



    //gets all  loans journal entries
    public function actionLoansJournals()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new JournalEntrySearch();
            $dataProvider = $searchModel->searchLoans(Yii::$app->request->queryParams);

            return $this->render('loans_journal_entries', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }




    //gets loan schedule
    public function actionLoanSchedule()
    {
        if (!Yii::$app->user->isGuest) {
            $searchModel = new ContractAmountDueSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('loan_schedule', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            $model = new LoginForm();
            return $this->redirect(['site/login',
                'model' => $model,
            ]);
        }
    }





    //gets all customer balances
    public function actionAccountBalance()
    {
        $searchModel = new AccdailyBalSearch();
        $dataProvider = $searchModel->searchAll(Yii::$app->request->queryParams);

        return $this->render('cust_balances', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Report model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Report the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Report::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * gets today sales report
     */

    public function actionTodaysales()
    {
        return $this->render('today_sales');
    }
}
