<?php
use Phalcon\ModelBase;

class TresorerieCategories extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $trca_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false)
	 */
	public $trca_nom;

	/**
	 * @Column(column='code', type='string', mtype='varchar', nullable=true, key='UNI', 'length': 64)
	 */
	public $trca_code;

	/**
	 * @Column(column='type', type='', mtype='enum', nullable=false, key='MUL', 'length': 'revenu,depense')
	 */
	public $trca_type;

	/**
	 * @Column(column='couleur', type='text', mtype='text', nullable=true)
	 */
	public $trca_couleur;

	/**
	 * @Column(column='ordre', type='integer', mtype='int', nullable=true, default='0')
	 */
	public $trca_ordre;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=true, default='CURRENT_TIMESTAMP')
	 */
	public $trca_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('trca_id', 'TresorerieDepenses', 'trde_categorie_id', array('alias' => 'tresorerie_depenses_categorie_id'));
		$this->hasMany('trca_id', 'TresorerieOperationsBancaires', 'tropba_categorie_id', array('alias' => 'tresorerie_operations_bancaires_categorie_id'));
		$this->hasMany('trca_id', 'TresorerieRevenus', 'trre_categorie_id', array('alias' => 'tresorerie_revenus_categorie_id'));


        $this->setSource('tresorerie_categories');
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
            'id' => 'trca_id',
			'nom' => 'trca_nom',
			'code' => 'trca_code',
			'type' => 'trca_type',
			'couleur' => 'trca_couleur',
			'ordre' => 'trca_ordre',
			'created_at' => 'trca_created_at'
        );
    }

}
