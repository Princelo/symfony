<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\DataTransformer\DateTimeToStringTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\Choice;

class SongType extends AbstractType
{
    public $strCompany;
    protected $boolIsEdit;
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choice = new Choice();
        $builder->add('strTitle', 'text', array('label'=>'歌曲名称',
            'attr'=>array(
                'data-validate'=>'required'
            )));
        $builder->add('arrStrArtistName', 'collection',
            array(
                'type' => new ArtistType(),
                'allow_add'    => true,
                'label' => false,
            ));
        $builder->add('strSpecial', 'text', array('label'=>'专辑名称'));
        $builder->add('strLyricist', 'text', array('label'=>'作詞人'));
        $builder->add('strComposer', 'text', array('label'=>'作曲人'));
        if(!$this->boolIsEdit)
            $builder->add('strCorpName', 'text', array('label'=>'所属公司',
            'data'=>$this->strCompany,
            'attr'=>array(
                'data-validation'=>'required'
            )));
        else
            $builder->add('strCorpName', 'text', array('label'=>'所属公司',
                'attr'=>array(
                    'data-validation'=>'required'
                )));
        $builder->add('boolIsRank', 'checkbox', array('label'=>'是否打榜'));
        $builder->add('timeRankTimeFrom', 'date', array('label'=>false,
            //'data_class'=>'\ArrayAccess',
            'widget'=>'single_text',
            'format'=>'y-M-d',
            'attr'=>array(
                'class'=>'datepicker'
            )));
        $builder->add('timeRankTimeTo', 'date', array('label'=>false,
            //'data_class'=>'\ArrayAccess',
            'widget'=>'single_text',
            'format'=>'y-M-d',
            'attr'=>array(
                'class'=>'datepicker'
            )));
        $builder->add('intRankZone', 'choice', array('label'=>'打榜區域',
            'choices'=>$choice->getZonelist()));
        $builder->add('boolIsPremiere', 'checkbox', array('label'=>'是否首播'));
        $builder->add('boolIsMain', 'checkbox', array('label'=>'是否主打'));
        $builder->add('intCategory', 'choice', array('label'=>'歌曲分类',
            'choices'=>$choice->getSongCategorylist()));
        $builder->add('intStyle', 'choice', array('label'=>'歌曲风格',
            'choices'=>$choice->getSongStylelist()));
        if(!$this->boolIsEdit){
            $builder->add('strPromotionFile', 'file', array('label'=>'宣传文案',
                'data_class'=>null,
            ));
            $builder->add('strCoverFile', 'file', array('label'=>'封面图片',
                'data_class'=>null,
            ));
            $builder->add('strLyricFile', 'file', array('label'=>'歌词文件',
                'data_class'=>null,
            ));
            $builder->add('strAuthFile', 'file', array('label'=>'上传授权书',
                'data_class'=>null,
            ));
            $builder->add('strSongFile', 'text', array('label'=>false,
                'attr'=>array(
                    'class'=>'songinput hidden'
                )));
        }
        $builder->add('strOtherLink1', 'text', array('label'=>false,
            'attr'=>array(
                'data-validate'=>'url'
            )));
        $builder->add('strOtherLink2', 'text', array('label'=>false,
            'attr'=>array(
                'data-validate'=>'url'
            )));
        $builder->add('strOtherLink3', 'text', array('label'=>false,
            'attr'=>array(
                'data-validate'=>'url'
            )));
        if(!$this->boolIsEdit)
            $builder->add('请上传歌曲...', 'submit', array(
                'attr'=>array(
                    'disabled'=>'disabled'
                )));
        else
            $builder->add('提交', 'submit', array(
                ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BackendBundle\Entity\Song',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'song';
    }

    public function setStrCompany($strCompany)
    {
        $this->strCompany = $strCompany;
    }

    public function setBoolIsEdit($boolIsEdit)
    {
        $this->boolIsEdit = $boolIsEdit;
        return $this;
    }
}