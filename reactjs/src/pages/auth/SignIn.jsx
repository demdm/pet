import React, {useState} from 'react';
import {
    Card,
    Form,
    Input,
    Button,
    Row,
    Col,
    message,
} from 'antd';
import axios from 'axios';
import {Link} from "react-router-dom";
import {authenticate, getTokenValue} from "../../services/security/Identifier";

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

const SignIn = () => {
    const [form] = Form.useForm();
    const [submitLoading, setSubmitLoading] = useState(false);

    const onFinish = values => {
        setSubmitLoading(true);

        // axios.defaults.headers['X-AUTH-TOKEN'] = getTokenValue();
        // axios.defaults.headers.common['X-AUTH-TOKEN'] = getTokenValue();

        axios
            .post('http://localhost/api/sign-in', values)
            .then(response => {
                let {data, status} = response;

                if (status !== 200) {
                    message.error(`Ошибка на сервере. Код ответа: ${status}.`);
                    return;
                }

                if (!data.isSuccess) {
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

                authenticate(data.data.token)
            })
            .catch(error => {
                message.error('Непредвиденная ошибка.');
            })
            .finally(() => {
                setSubmitLoading(false);
            })
        ;
    };

    const onFinishFailed = errorInfo => {
        console.log('Failed:', errorInfo);
    };

    return (
        <Row>
            <Col span={9}> </Col>
            <Col span={6}>
                <Card title="Вход">
                    <Form
                        {...layout}
                        form={form}
                        name="sign-up"
                        onFinish={onFinish}
                        onFinishFailed={onFinishFailed}
                    >
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
                                Войти
                            </Button>
                            <p>
                                У тебя нет аккаунта? <Link to={'/sign-up'}>Регистрация!</Link>
                            </p>
                        </Form.Item>
                    </Form>
                </Card>
            </Col>
            <Col span={9}> </Col>
        </Row>
    );
};

export default SignIn;