<?php
use Phalcon\ModelBase;

class DocumentRelations extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $dore_id;

	/**
	 * @Column(column='document_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dore_document_id;

	/**
	 * @Column(column='related_tache_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dore_related_tache_id;

	/**
	 * @Column(column='related_etablissement_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dore_related_etablissement_id;

	/**
	 * @Column(column='related_contact_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dore_related_contact_id;

	/**
	 * @Column(column='related_profile_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dore_related_profile_id;

	/**
	 * @Column(column='related_groupe_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $dore_related_groupe_id;

	/**
	 * @Column(column='related_partenaire_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $dore_related_partenaire_id;

	/**
	 * @Column(column='related_email_thread_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $dore_related_email_thread_id;

	/**
	 * @Column(column='related_rd_user_story_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $dore_related_rd_user_story_id;

	/**
	 * @Column(column='related_support_ticket_id', type='string', mtype='varchar', nullable=true, 'length': 36)
	 */
	public $dore_related_support_ticket_id;

	/**
	 * @Column(column='relation_type', type='', mtype='enum', nullable=false, default='attachment', 'length': 'source,deliverable,contrat,facture,rh,procedure,attachment,reference,archive,other')
	 */
	public $dore_relation_type;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $dore_created_at;

	/**
	 * @Column(column='created_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $dore_created_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('dore_related_contact_id', 'Contacts', 'co_id', array('alias' => 'contacts_related_contact_id'));
		$this->belongsTo('dore_created_by', 'Users', 'us_id', array('alias' => 'users_created_by'));
		$this->belongsTo('dore_document_id', 'Documents', 'do_id', array('alias' => 'documents_document_id'));
		$this->belongsTo('dore_related_email_thread_id', 'EmailThreads', 'emth_id', array('alias' => 'email_threads_related_email_thread_id'));
		$this->belongsTo('dore_related_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_related_etablissement_id'));
		$this->belongsTo('dore_related_profile_id', 'Profiles', 'pr_id', array('alias' => 'profiles_related_profile_id'));
		$this->belongsTo('dore_related_tache_id', 'Taches', 'ta_id', array('alias' => 'taches_related_tache_id'));

        $this->setSource('document_relations');
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
            'id' => 'dore_id',
			'document_id' => 'dore_document_id',
			'related_tache_id' => 'dore_related_tache_id',
			'related_etablissement_id' => 'dore_related_etablissement_id',
			'related_contact_id' => 'dore_related_contact_id',
			'related_profile_id' => 'dore_related_profile_id',
			'related_groupe_id' => 'dore_related_groupe_id',
			'related_partenaire_id' => 'dore_related_partenaire_id',
			'related_email_thread_id' => 'dore_related_email_thread_id',
			'related_rd_user_story_id' => 'dore_related_rd_user_story_id',
			'related_support_ticket_id' => 'dore_related_support_ticket_id',
			'relation_type' => 'dore_relation_type',
			'created_at' => 'dore_created_at',
			'created_by' => 'dore_created_by'
        );
    }

}
