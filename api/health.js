module.exports = (req, res) => {
    res.setHeader('Content-Type', 'application/json');
    res.end(JSON.stringify({ status: 'ok', platform: 'vercel', time: new Date().toISOString() }));
};
