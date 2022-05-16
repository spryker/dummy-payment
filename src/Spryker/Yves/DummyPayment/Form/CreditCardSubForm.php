<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Yves\DummyPayment\Form;

use Generated\Shared\Transfer\DummyPaymentTransfer;
use Spryker\Shared\DummyPayment\DummyPaymentConfig;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreditCardSubForm extends AbstractSubForm
{
    /**
     * @var string
     */
    public const PAYMENT_METHOD = 'credit_card';

    /**
     * @var string
     */
    public const FIELD_CARD_TYPE = 'card_type';

    /**
     * @var string
     */
    public const FIELD_CARD_NUMBER = 'card_number';

    /**
     * @var string
     */
    public const FIELD_NAME_ON_CARD = 'name_on_card';

    /**
     * @var string
     */
    public const FIELD_CARD_EXPIRES_MONTH = 'card_expires_month';

    /**
     * @var string
     */
    public const FIELD_CARD_EXPIRES_YEAR = 'card_expires_year';

    /**
     * @var string
     */
    public const FIELD_CARD_SECURITY_CODE = 'card_security_code';

    /**
     * @var string
     */
    public const OPTION_CARD_EXPIRES_CHOICES_MONTH = 'month choices';

    /**
     * @var string
     */
    public const OPTION_CARD_EXPIRES_CHOICES_YEAR = 'year choices';

    /**
     * @return string
     */
    public function getName(): string
    {
        return DummyPaymentConfig::PAYMENT_METHOD_CREDIT_CARD;
    }

    /**
     * @return string
     */
    public function getPropertyPath(): string
    {
        return DummyPaymentConfig::PAYMENT_METHOD_CREDIT_CARD;
    }

    /**
     * @return string
     */
    public function getTemplatePath(): string
    {
        return DummyPaymentConfig::PROVIDER_NAME . '/' . static::PAYMENT_METHOD;
    }

    /**
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DummyPaymentTransfer::class,
        ])->setRequired(static::OPTIONS_FIELD_NAME);
    }

    /**
     * @deprecated Use {@link configureOptions()} instead.
     *
     * @param \Symfony\Component\OptionsResolver\OptionsResolver $resolver
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolver $resolver): void
    {
        $this->configureOptions($resolver);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->addCardType($builder)
            ->addCardNumber($builder)
            ->addNameOnCard($builder)
            ->addCardExpiresMonth($builder, $options)
            ->addCardExpiresYear($builder, $options)
            ->addCardSecurityCode($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    public function addCardType(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_CARD_TYPE,
            ChoiceType::class,
            [
                'choices' => ['Visa' => 'Visa', 'Master Card' => 'Master Card'],
                'label' => 'dummyPaymentCreditCard.card_type',
                'required' => true,
                'expanded' => false,
                'multiple' => false,
                'placeholder' => false,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ],
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addCardNumber(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_CARD_NUMBER,
            TextType::class,
            [
                'label' => 'dummyPaymentCreditCard.card_number',
                'required' => true,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ],
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addNameOnCard(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_NAME_ON_CARD,
            TextType::class,
            [
                'label' => 'dummyPaymentCreditCard.name_on_card',
                'required' => true,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ],
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addCardExpiresMonth(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            static::FIELD_CARD_EXPIRES_MONTH,
            ChoiceType::class,
            [
                'label' => 'dummyPaymentCreditCard.card_expires',
                'choices' => array_flip($options[static::OPTIONS_FIELD_NAME][static::OPTION_CARD_EXPIRES_CHOICES_MONTH]),
                'required' => true,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ],
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array<string, mixed> $options
     *
     * @return $this
     */
    protected function addCardExpiresYear(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            static::FIELD_CARD_EXPIRES_YEAR,
            ChoiceType::class,
            [
                'label' => false,
                'choices' => array_flip($options[static::OPTIONS_FIELD_NAME][static::OPTION_CARD_EXPIRES_CHOICES_YEAR]),
                'required' => true,
                'attr' => [
                    'placeholder' => 'Expires year',
                ],
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ],
        );

        return $this;
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addCardSecurityCode(FormBuilderInterface $builder)
    {
        $builder->add(
            static::FIELD_CARD_SECURITY_CODE,
            TextType::class,
            [
                'label' => 'dummyPaymentCreditCard.card_security_code',
                'required' => true,
                'constraints' => [
                    $this->createNotBlankConstraint(),
                ],
            ],
        );

        return $this;
    }
}
