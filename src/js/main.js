


function runOnLoad (func) {
    window.onload = func;
}

runOnLoad(function () {


    const gl = webgl.prepareWebGlContext(document.getElementById('canvas'));


    const buffers = webgl.initBuffers(gl);

    let then = 0;


    const shaderProgram = webgl.initializeShaderProgram(gl, webgl.shaders.colors.vertexSource, webgl.shaders.colors.fragmentSource);

    const programInfo = {
        program: shaderProgram,
        attribLocations: {
            vertexPosition: gl.getAttribLocation(shaderProgram, 'aVertexPosition'),
            vertexColor: gl.getAttribLocation(shaderProgram, 'aVertexColor'),
        },
        uniformLocations: {
            projectionMatrix: gl.getUniformLocation(shaderProgram, 'uProjectionMatrix'),
            modelViewMatrix: gl.getUniformLocation(shaderProgram, 'uModelViewMatrix')
        }
    };



    function render(now) {
        now *= 0.001;  // convert to seconds
        const deltaTime = now - then;
        then = now;

        webgl.drawScene(gl, programInfo, buffers, mat4, deltaTime);

        requestAnimationFrame(render);
    }
    requestAnimationFrame(render);



    // webgl.drawScene(gl, programInfo, buffers, mat4);


});






