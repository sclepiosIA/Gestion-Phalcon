<?
use Phalcon\ModelBase;

class EmailTemplates extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $emte_id;

	/**
	 * @Column(column='name', type='text', mtype='text', nullable=false)
	 */
	public $emte_name;

	/**
	 * @Column(column='subject', type='text', mtype='text', nullable=false)
	 */
	public $emte_subject;

	/**
	 * @Column(column='content', type='text', mtype='longtext', nullable=false)
	 */
	public $emte_content;

	/**
	 * @Column(column='variables', type='', mtype='json', nullable=true)
	 */
	public $emte_variables;

	/**
	 * @Column(column='is_active', type='integer', mtype='tinyint', nullable=false, default='1', key='MUL', 'length': 1)
	 */
	public $emte_is_active;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $emte_created_by;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $emte_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $emte_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('emte_created_by', 'Users', 'us_id', array('alias' => 'users_created_by'));

        $this->setSource('email_templates');
        parent::initialize();
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap():array
    {
        return array(
            'id' => 'emte_id',
			'name' => 'emte_name',
			'subject' => 'emte_subject',
			'content' => 'emte_content',
			'variables' => 'emte_variables',
			'is_active' => 'emte_is_active',
			'created_by' => 'emte_created_by',
			'created_at' => 'emte_created_at',
			'updated_at' => 'emte_updated_at'
        );
    }

}
