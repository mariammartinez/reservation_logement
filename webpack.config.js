const path = require('path');
const StylelintPlugin = require('stylelint-webpack-plugin');

const config = {
    cache: true,
    entry: {
        //public: './assets/js/public.js',
        private: './assets/js/app.js',
    },
    output: {
        path: path.resolve(__dirname, './public/build'),
        filename: '[name].bundle.js',
        publicPath: '/build/'
    },
    module: {
        rules: [
            /*{
                enforce: 'pre',
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'eslint-loader',
                options: {
                    fix: true
                }
            },*/
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: ['babel-loader']
            },
            {
                test: /\.scss$/,
                loader: ['style-loader', 'css-loader', 'postcss-loader', 'sass-loader']
            },
            {
                test: /\.woff(2)?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                loader: 'url-loader?limit=10000&mimetype=application/font-woff'
            },
            {
                test: /\.(ttf|eot|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
                loader: 'file-loader'
            },
            {
                test: /\.(png|jp(e*)g|svg)$/,
                use: [{
                    loader: 'url-loader',
                    options: {
                        limit: 8000,
                        name: 'img/[hash]-[name].[ext]'
                    }
                }]
            }
        ]
    },
    plugins: [
        /*new StylelintPlugin({
            configFile: '.stylelintrc',
            context: './assets/css/'
        })*/
    ]
};

module.exports = config;