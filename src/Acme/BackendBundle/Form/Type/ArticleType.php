<?php
namespace Acme\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Acme\BackendBundle\Entity\Choice;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $choice = new Choice();
        /*$builder->add('textContent', 'ckeditor', array(
            'filebrowser_image_browse_url' => array(
                'route'            => 'elfinder',
                'route_parameters' => array('instance' => 'ckeditor'),
            ),
            'config' => array(
                'toolbar' => array(
                    array(
                        'name'  => 'document',
                        'items' => array('Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print', '-', 'Templates'),
                    ),
                    '/',
                    array(
                        'name'  => 'basicstyles',
                        'items' => array('Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'),
                    ),
                    array(
                        'name' => 'styles',
                        'items' => array('Styles','Format','Font','FontSize')
                    ),
                    array(
                        'name' => 'colors',
                        'items' => array('TextColor', 'BGColor')
                    ),
                ),
                'uiColor' => '#ffffff',
                'font_names' => 'Microsoft YaHei;SimSun;PMingLiU;Arial/Arial, Helvetica, sans-serif;Comic Sans MS/Comic Sans MS, cursive;Courier New/Courier New, Courier, monospace;Georgia/Georgia, serif;Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;Tahoma/Tahoma, Geneva, sans-serif;Times New Roman/Times New Roman, Times, serif;Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;Verdana/Verdana, Geneva, sans-serif',
                'filebrowserBrowseRoute'           => 'elfinder',
                //'filebrowserBrowseRouteParameters' => array('slug' => 'my-slug'),
                'filebrowserBrowseRouteAbsolute'   => true,
            )));*/
        $builder->add('intCategory', 'choice', array(
            'choices' => $choice->getCategorylist(),
            'label' => "所属类別",
        ));
        $builder->add('strTitle', 'text', array(
            'label' => "文章标题",
        ));
        $builder->add('strThumb', 'file', array(
            'label' => '缩略图',
            'data_class' => null,
        ));
        $builder->add('textContent', 'ckeditor', array(
            'label' => '文章內容',
            'config' => array(
                'font_names' => 'Microsoft YaHei;SimSun;PMingLiU;Arial/Arial, Helvetica, sans-serif;Comic Sans MS/Comic Sans MS, cursive;Courier New/Courier New, Courier, monospace;Georgia/Georgia, serif;Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;Tahoma/Tahoma, Geneva, sans-serif;Times New Roman/Times New Roman, Times, serif;Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;Verdana/Verdana, Geneva, sans-serif',
            )
        ));
        $builder->add('提交', 'submit', array(
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\FrontendBundle\Entity\Article',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
        ));
    }

    public function getName()
    {
        return 'article';
    }

}