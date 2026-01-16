<?
use Phalcon\ModelBase;

class PartenairesContacts extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $paco_id;

	/**
	 * @Column(column='partenaire_id', type='string', mtype='varchar', nullable=false, key='MUL', 'onUpdate': 'NO ACTION', 'onDelete': 'CASCADE', 'length': 36)
	 */
	public $paco_partenaire_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $paco_nom;

	/**
	 * @Column(column='prenom', type='text', mtype='text', nullable=true)
	 */
	public $paco_prenom;

	/**
	 * @Column(column='fonction', type='text', mtype='text', nullable=true)
	 */
	public $paco_fonction;

	/**
	 * @Column(column='email', type='string', mtype='varchar', nullable=true, key='MUL', 'length': 255)
	 */
	public $paco_email;

	/**
	 * @Column(column='telephone', type='string', mtype='varchar', nullable=true, 'length': 50)
	 */
	public $paco_telephone;

	/**
	 * @Column(column='est_contact_principal', type='integer', mtype='tinyint', nullable=true, default='0', 'length': 1)
	 */
	public $paco_est_contact_principal;

	/**
	 * @Column(column='notes', type='text', mtype='longtext', nullable=true)
	 */
	public $paco_notes;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $paco_created_at;

	/**
	 * @Column(column='updated_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP', extra='DEFAULT_GENERATED on update CURRENT_TIMESTAMP')
	 */
	public $paco_updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->belongsTo('paco_partenaire_id', 'Partenaires', 'pa_id', array('alias' => 'partenaires_partenaire_id'));

        $this->setSource('partenaires_contacts');
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
            'id' => 'paco_id',
			'partenaire_id' => 'paco_partenaire_id',
			'nom' => 'paco_nom',
			'prenom' => 'paco_prenom',
			'fonction' => 'paco_fonction',
			'email' => 'paco_email',
			'telephone' => 'paco_telephone',
			'est_contact_principal' => 'paco_est_contact_principal',
			'notes' => 'paco_notes',
			'created_at' => 'paco_created_at',
			'updated_at' => 'paco_updated_at'
        );
    }

}
