import React, {useState} from 'react';
import {
    Card,
    Form,
    Input,
    Button,
    Row,
    Col,
    message
} from 'antd';
import axios from 'axios';
import {Link, Redirect} from "react-router-dom";

const layout = {
    labelCol: {
        span: 4,
    },
    wrapperCol: {
        span: 20,
    },
};
const tailLayout = {
    wrapperCol: {
        offset: 4,
        span: 20,
    },
};

const SignUp = () => {
    const [form] = Form.useForm();
    const [redirect, setRedirect] = useState(false);
    const [submitLoading, setSubmitLoading] = useState(false);

    const onFinish = values => {
        setSubmitLoading(true);

        axios
            .post('sign-up', values)
            .then(response => {
                let {data, status} = response;

                if (status !== 200) {
                    message.error(`Ошибка на сервере. Код ответа: ${status}.`);
                    return;
                }

                if (data.isSuccess === false) {
                    data.violations.violations.forEach(violation => {
                        form.setFields([
                            {
                                name: violation.propertyPath,
                                value: values[violation.propertyPath],
                                errors: [violation.title],
                            },
                        ]);
                    });
                    return;
                }

                form.resetFields();

                message.success('Регистрация успешна! Редирект на страницу Входа чере 3 сек...');

                setTimeout(function () {
                    setRedirect(true);
                }, 3000);
            })
            .catch(error => {
                message.error('Непредвиденная ошибка.');
            })
            .finally(() => {
                setSubmitLoading(false);
            })
        ;
    };

    if (redirect === true) {
        return <Redirect to='/sign-in'/>;
    }

    return (
        <Row>
            <Col span={9}> </Col>
            <Col span={6}>
                <Card title="Регистрация">
                    <Form
                        {...layout}
                        form={form}
                        name="sign-up"
                        onFinish={onFinish}
                    >
                        <Form.Item
                            label="Имя"
                            name="name"
                            rules={[
                                {
                                    required: true,
                                    message: 'Введи имя',
                                },
                                {
                                    min: 1,
                                    max: 100,
                                    message: 'Имя должно содержать от 1 до 100 символов'
                                },
                            ]}
                        >
                            <Input />
                        </Form.Item>

                        <Form.Item
                            name='email'
                            label="Email"
                            rules={[
                                {
                                    required: true,
                                    type: 'email',
                                    message: 'Введи правильный email',
                                },
                            ]}
                        >
                            <Input />
                        </Form.Item>

                        <Form.Item
                            label="Пароль"
                            name="password"
                            rules={[
                                {
                                    required: true,
                                    message: 'Введи пароль',
                                },
                                {
                                    min: 6,
                                    max: 255,
                                    message: 'Пароль должно содержать от 6 до 255 символов'
                                },
                            ]}
                        >
                            <Input.Password />
                        </Form.Item>

                        <Form.Item {...tailLayout} style={{marginBottom: 0}}>
                            <Button type="primary" htmlType="submit" loading={submitLoading}>
                                Зарегистрироваться
                            </Button>
                            <p>
                                У тебя уже есть аккаунт? <Link to={'/sign-in'}>Вход!</Link>
                            </p>
                        </Form.Item>
                    </Form>
                </Card>
            </Col>
            <Col span={9}> </Col>
        </Row>
    );
};

export default SignUp;