<?php
use Phalcon\ModelBase;

class Contacts extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $co_id;

	/**
	 * @Column(column='etablissement_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $co_etablissement_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $co_nom;

	/**
	 * @Column(column='prenom', type='text', mtype='text', nullable=true)
	 */
	public $co_prenom;

	/**
	 * @Column(column='fonction', type='text', mtype='text', nullable=false)
	 */
	public $co_fonction;

	/**
	 * @Column(column='email', type='text', mtype='text', nullable=true)
	 */
	public $co_email;

	/**
	 * @Column(column='telephone', type='text', mtype='text', nullable=true)
	 */
	public $co_telephone;

	/**
	 * @Column(column='est_contact_principal', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $co_est_contact_principal;

	/**
	 * @Column(column='type_contact', type='text', mtype='text', nullable=true)
	 */
	public $co_type_contact;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $co_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $co_updated_at;

	/**
	 * @Column(column='groupe_id', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $co_groupe_id;

	/**
	 * @Column(column='niveau_contact', type='string', mtype='varchar', nullable=false, default='etablissement', 'length': 20)
	 */
	public $co_niveau_contact;

	/**
	 * @Column(column='updated_by', type='string', mtype='varchar', nullable=true, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'SET NULL', 'length': 36)
	 */
	public $co_updated_by;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('co_id', 'DocumentRelations', 'dore_related_contact_id', array('alias' => 'document_relations_related_contact_id'));

		$this->belongsTo('co_etablissement_id', 'Etablissements', 'et_id', array('alias' => 'etablissements_etablissement_id'));
		$this->belongsTo('co_groupe_id', 'GroupesEtablissements', 'gret_id', array('alias' => 'groupes_etablissements_groupe_id'));
		$this->belongsTo('co_updated_by', 'Users', 'us_id', array('alias' => 'users_updated_by'));

        $this->setSource('contacts');
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
            'id' => 'co_id',
			'etablissement_id' => 'co_etablissement_id',
			'nom' => 'co_nom',
			'prenom' => 'co_prenom',
			'fonction' => 'co_fonction',
			'email' => 'co_email',
			'telephone' => 'co_telephone',
			'est_contact_principal' => 'co_est_contact_principal',
			'type_contact' => 'co_type_contact',
			'created_at' => 'co_created_at',
			'updated_at' => 'co_updated_at',
			'groupe_id' => 'co_groupe_id',
			'niveau_contact' => 'co_niveau_contact',
			'updated_by' => 'co_updated_by'
        );
    }

}
