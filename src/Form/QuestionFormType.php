<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class QuestionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var Question $question */
        $question = $options['data'];
        $builder
            ->add('alternatives', ChoiceType::class, [
                'label' => false,
                'choices' => $question->getAlternatives(),
                'choice_label' => 'description',
                'choice_value' => 'id',
                'expanded' => true,
                'multiple' => false,
                'mapped' => false,
                'block_name' => 'alternatives',
                'placeholder' => false,
                'constraints' => [
                    new NotBlank(['message' => 'Selecione uma alternativa']),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
            'number' => null,
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['number'] = $options['number'];
    }
}
