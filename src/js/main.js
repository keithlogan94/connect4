


function runOnLoad (func) {
    window.onload = func;
}

runOnLoad(function () {


    const gl = webgl.prepareWebGlContext(document.getElementById('canvas'));


    const buffers = webgl.initBuffers(gl);

    const programInfo = webgl.initializeProgramInfo(gl, webgl.shaders.colors.vertexSource, webgl.shaders.colors.fragmentSource);


    webgl.drawScene(gl, programInfo, buffers, mat4);


});






