import React from 'react';
import { Card, Form, Input, Button, Row, Col, Space } from 'antd';
import axios from 'axios';

const layout = {
    labelCol: {
        span: 8,
    },
    wrapperCol: {
        span: 16,
    },
};
const tailLayout = {
    wrapperCol: {
        offset: 8,
        span: 16,
    },
};

const SignUp = () => {
    const [form] = Form.useForm();

    const onFinish = values => {
        axios
            .post('sign-up', values)
            .then(response => {
                let {data, status} = response;
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
                }
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    };

    const onFinishFailed = errorInfo => {
        console.log('Failed:', errorInfo);
    };

    return (
        <Row>
            <Col span={9}> </Col>
            <Col span={6}>
                <Space direction="vertical">
                    <Card title="Регистрация">
                        <Form
                            {...layout}
                            form={form}
                            name="sign-up"
                            onFinish={onFinish}
                            onFinishFailed={onFinishFailed}
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
                                <Button type="primary" htmlType="submit">
                                    Зарегистрироваться
                                </Button>
                            </Form.Item>
                        </Form>
                    </Card>
                </Space>
            </Col>
            <Col span={9}> </Col>
        </Row>
    );
};

export default SignUp;