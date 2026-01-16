<?php
use Phalcon\ModelBase;

class CategoriesTaches extends ModelBase
{
    
	/**
	 * @Primary
	 * @Column(column='id', type='string', mtype='varchar', nullable=false, key='PRI', 'length': 36)
	 */
	public $cata_id;

	/**
	 * @Column(column='nom', type='text', mtype='text', nullable=false, key='UNI')
	 */
	public $cata_nom;

	/**
	 * @Column(column='description', type='text', mtype='text', nullable=true)
	 */
	public $cata_description;

	/**
	 * @Column(column='ordre', type='integer', mtype='int', nullable=false, default='0')
	 */
	public $cata_ordre;

	/**
	 * @Column(column='couleur', type='text', mtype='text', nullable=true)
	 */
	public $cata_couleur;

	/**
	 * @Column(column='created_at', type='datetime', mtype='datetime', nullable=false, default='CURRENT_TIMESTAMP')
	 */
	public $cata_created_at;

    /**
     * Initialize method for model.
     */
    public function initialize():void
    {
		$this->hasMany('cata_id', 'ModelesTaches', 'mota_categorie_id', array('alias' => 'modeles_taches_categorie_id'));
		$this->hasMany('cata_id', 'Taches', 'ta_categorie_id', array('alias' => 'taches_categorie_id'));


        $this->setSource('categories_taches');
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
            'id' => 'cata_id',
			'nom' => 'cata_nom',
			'description' => 'cata_description',
			'ordre' => 'cata_ordre',
			'couleur' => 'cata_couleur',
			'created_at' => 'cata_created_at'
        );
    }

}
