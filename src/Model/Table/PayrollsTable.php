<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Payrolls Model
 *
 * @property \App\Model\Table\LogsTable|\Cake\ORM\Association\HasMany $Logs
 *
 * @method \App\Model\Entity\Payroll get($primaryKey, $options = [])
 * @method \App\Model\Entity\Payroll newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Payroll[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Payroll|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payroll|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payroll patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Payroll[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Payroll findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PayrollsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('payrolls');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Logs', [
            'foreignKey' => 'payroll_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->date('bill_date')
            ->requirePresence('bill_date', 'create')
            ->notEmpty('bill_date');

        $validator
            ->date('start_date')
            ->requirePresence('start_date', 'create')
            ->notEmpty('start_date');

        $validator
            ->date('end_date')
            ->requirePresence('end_date', 'create')
            ->notEmpty('end_date');

        $validator
            ->scalar('file')
            ->maxLength('file', 255)
            ->requirePresence('file', 'create')
            ->notEmpty('file');

        $validator
            ->boolean('is_thirteen_month_pay')
            ->allowEmpty('is_thirteen_month_pay');

        return $validator;
    }
}
