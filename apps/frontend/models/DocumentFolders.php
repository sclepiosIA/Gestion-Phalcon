<?
use Phalcon\ModelBase;

class DocumentFolders extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $dofo_id;

	/**
	 * @Column(column='name', type='text', mtype='text', nullable=false)
	 */
	public $dofo_name;

	/**
	 * @Column(column='parent_folder_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dofo_parent_folder_id;

	/**
	 * @Column(column='owner_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dofo_owner_id;

	/**
	 * @Column(column='folder_type', type='string', mtype='varchar', nullable=false, default='personal', key='MUL', 'length': 20)
	 */
	public $dofo_folder_type;

	/**
	 * @Column(column='related_etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dofo_related_etablissement_id;

	/**
	 * @Column(column='icon', type='text', mtype='text', nullable=true)
	 */
	public $dofo_icon;

	/**
	 * @Column(column='color', type='text', mtype='text', nullable=true)
	 */
	public $dofo_color;

	/**
	 * @Column(column='position', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $dofo_position;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $dofo_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $dofo_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('dofo_id', 'DocumentFolders', 'dofo_parent_folder_id', array('alias' => 'document_folders_parent_folder_id'));
		$this->hasMany('dofo_id', 'Documents', 'do_folder_id', array('alias' => 'documents_folder_id'));

		$this->belongsTo('dofo_related_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_related_etablissement_id'));
		$this->belongsTo('dofo_owner_id', 'Users', 'us_id', array('alias' => 'users_owner_id'));
		$this->belongsTo('dofo_parent_folder_id', 'DocumentFolders', 'dofo_id', array('alias' => 'document_folders_parent_folder_id'));

        $this->setSource('document_folders');
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
            'id' => 'dofo_id',
			'name' => 'dofo_name',
			'parent_folder_id' => 'dofo_parent_folder_id',
			'owner_id' => 'dofo_owner_id',
			'folder_type' => 'dofo_folder_type',
			'related_etablissement_id' => 'dofo_related_etablissement_id',
			'icon' => 'dofo_icon',
			'color' => 'dofo_color',
			'position' => 'dofo_position',
			'created_at' => 'dofo_created_at',
			'updated_at' => 'dofo_updated_at'
        );
    }

}
